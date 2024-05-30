<?php


namespace App\Strategies;

use App\Models\Guia;
use DOMDocument;
use Illuminate\Support\Collection;
use SimpleXMLElement;

class TissXml3_04_00 implements TissXmlStrategy
{

    public function gerar(Collection $guias, int $lote): string
    {
        // Inicia a criação do XML
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><ans:mensagemTISS xmlns:ans="http://www.ans.gov.br/padroes/tiss/schemas"></ans:mensagemTISS>');

        // Adiciona o cabeçalho
        $cabecalho = $xml->addChild('ans:cabecalho');
        $identificacaoTransacao = $cabecalho->addChild('ans:identificacaoTransacao');
        $identificacaoTransacao->addChild('ans:tipoTransacao', 'ENVIO_LOTE_GUIAS');
        $identificacaoTransacao->addChild('ans:sequencialTransacao', '1'); // Este valor deve ser gerado ou incrementado dinamicamente
        $identificacaoTransacao->addChild('ans:dataRegistroTransacao', date('Y-m-d'));
        $identificacaoTransacao->addChild('ans:horaRegistroTransacao', date('H:i:s'));

        // Adiciona informações de origem e destino
        $origem = $cabecalho->addChild('ans:origem');
        $identificacaoPrestador = $origem->addChild('ans:identificacaoPrestador');
        $identificacaoPrestador->addChild('ans:codigoPrestadorNaOperadora', $guias[0]->num_guia_prestador); // Exemplo, substituir pelo valor real

        $destino = $cabecalho->addChild('ans:destino');
        $destino->addChild('ans:registroANS', $guias[0]->convenio->numeroderegistro);

        $cabecalho->addChild('ans:Padrao', '3.04.00');

        // Adiciona o lote de guias e a guia específica
        $prestadorParaOperadora = $xml->addChild('ans:prestadorParaOperadora');
        $loteGuias = $prestadorParaOperadora->addChild('ans:loteGuias');
        $loteGuias->addChild('ans:numeroLote', $lote);

        $guiasTISS = $loteGuias->addChild('ans:guiasTISS');

        // Inclui guias do lote
        foreach ($guias as $guia) {

            $guiaConsulta = $guiasTISS->addChild('ans:guiaConsulta');

            // Cabeçalho da consulta
            $cabecalhoConsulta = $guiaConsulta->addChild('ans:cabecalhoConsulta');
            $cabecalhoConsulta->addChild('ans:registroANS', $guia->convenio->numeroderegistro);
            $cabecalhoConsulta->addChild('ans:numeroGuiaPrestador', $guia->num_guia_prestador);

            $guiaConsulta->addChild('ans:numeroGuiaOperadora', $guia->num_guia_operadora);

            // Dados do Beneficiário
            $dadosBeneficiario = $guiaConsulta->addChild('ans:dadosBeneficiario');
            $dadosBeneficiario->addChild('ans:numeroCarteira', $guia->beneficiario->cns);
            $dadosBeneficiario->addChild('ans:atendimentoRN', 'N');
            $dadosBeneficiario->addChild('ans:nomeBeneficiario', $guia->beneficiario->nome); // Exemplo, substituir pelo valor real

            // Contratado Executante
            $contratadoExecutante = $guiaConsulta->addChild('ans:contratadoExecutante');
            $contratadoExecutante->addChild('ans:codigoPrestadorNaOperadora', $guia->codigo_operadora_contratado);
            $contratadoExecutante->addChild('ans:nomeContratado', $guia->contratado->nome); // Exemplo, substituir pelo valor real
            $contratadoExecutante->addChild('ans:CNES', $guia->contratado->cnes);

            // Profissional Executante
            $profissionalExecutante = $guiaConsulta->addChild('ans:profissionalExecutante');
            $profissionalExecutante->addChild('ans:nomeProfissional', $guia->profissional->nome);
            $profissionalExecutante->addChild('ans:conselhoProfissional', $guia->profissional->conselho->codigo_termo);
            $profissionalExecutante->addChild('ans:numeroConselhoProfissional', $guia->profissional->conselho->codigo_termo);
            $profissionalExecutante->addChild('ans:UF', $guia->uf_conselho_profissional);
            $profissionalExecutante->addChild('ans:CBOS', $guia->cbo_s);

            // Indicação de Acidente e Dados do Atendimento
            $guiaConsulta->addChild('ans:indicacaoAcidente', $guia->indicador_acidente);

            $dadosAtendimento = $guiaConsulta->addChild('ans:dadosAtendimento');
            $dadosAtendimento->addChild('ansTISS:dataAtendimento', $guia->data);
            $dadosAtendimento->addChild('ansTISS:tipoConsulta', $guia->tipo_consulta);

            $procedimento = $dadosAtendimento->addChild('ans:procedimento');
            $procedimento->addChild('ans:codigoTabela', $guia->tabela);
            $procedimento->addChild('ans:codigoProcedimento', $guia->procedimento->codigo);
            $procedimento->addChild('ans:valorProcedimento', $guia->valor);

        }

        // Epílogo
        $epilogo = $xml->addChild('ans:epilogo');
        $xmlContent = $xml->asXML();

        $hashValue = hash('md5', $xmlContent);

        $epilogo->addChild('ans:hash', $hashValue);

        // Formata o XML para saída
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $xmlString = $dom->saveXML();

        return $xmlString;
    }
}
