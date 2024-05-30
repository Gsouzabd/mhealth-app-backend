<?php

namespace App\Strategies;

use App\Models\Guia;
use DOMDocument;
use Illuminate\Support\Collection;
use SimpleXMLElement;

class TissXml3_02_00 implements TissXmlStrategy
{

    public function gerar(Collection $guias, int $lote): string
    {
        // Inicia a criação do XML
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><ansTISS:mensagemTISS xmlns:ansTISS="http://www.ans.gov.br/padroes/tiss/schemas"></ansTISS:mensagemTISS>');

        // Adiciona o cabeçalho
        $cabecalho = $xml->addChild('ansTISS:cabecalho');
        $identificacaoTransacao = $cabecalho->addChild('ansTISS:identificacaoTransacao');
        $identificacaoTransacao->addChild('ansTISS:tipoTransacao', 'ENVIO_LOTE_GUIAS');
        $identificacaoTransacao->addChild('ansTISS:sequencialTransacao', '1'); // Este valor deve ser gerado ou incrementado dinamicamente
        $identificacaoTransacao->addChild('ansTISS:dataRegistroTransacao', date('Y-m-d'));
        $identificacaoTransacao->addChild('ansTISS:horaRegistroTransacao', date('H:i:s'));

        // Adiciona informações de origem e destino
        $origem = $cabecalho->addChild('ansTISS:origem');
        $identificacaoPrestador = $origem->addChild('ansTISS:identificacaoPrestador');
        $identificacaoPrestador->addChild('ansTISS:codigoPrestadorNaOperadora', $guias[0]->num_guia_prestador); // Exemplo, substituir pelo valor real

        $destino = $cabecalho->addChild('ansTISS:destino');
        $destino->addChild('ansTISS:registroANS', $guias[0]->convenio->numeroderegistro);

        $cabecalho->addChild('ansTISS:versaoPadrao', '3.02.00');

        // Adiciona o lote de guias e a guia específica
        $prestadorParaOperadora = $xml->addChild('ansTISS:prestadorParaOperadora');
        $loteGuias = $prestadorParaOperadora->addChild('ansTISS:loteGuias');
        $loteGuias->addChild('ansTISS:numeroLote', $lote);

        $guiasTISS = $loteGuias->addChild('ansTISS:guiasTISS');

        // Inclui guias do lote
        foreach ($guias as $guia){

            $guiaConsulta = $guiasTISS->addChild('ansTISS:guiaConsulta');

            // Cabeçalho da consulta
            $cabecalhoConsulta = $guiaConsulta->addChild('ansTISS:cabecalhoConsulta');
            $cabecalhoConsulta->addChild('ansTISS:registroANS', $guia->convenio->numeroderegistro);
            $cabecalhoConsulta->addChild('ansTISS:numeroGuiaPrestador', $guia->num_guia_prestador);

            $guiaConsulta->addChild('ansTISS:numeroGuiaOperadora', $guia->num_guia_operadora);

            // Dados do Beneficiário
            $dadosBeneficiario = $guiaConsulta->addChild('ansTISS:dadosBeneficiario');
            $dadosBeneficiario->addChild('ansTISS:numeroCarteira', $guia->beneficiario->cns);
            $dadosBeneficiario->addChild('ansTISS:atendimentoRN', 'N');
            $dadosBeneficiario->addChild('ansTISS:nomeBeneficiario', $guia->beneficiario->nome); // Exemplo, substituir pelo valor real

            // Contratado Executante
            $contratadoExecutante = $guiaConsulta->addChild('ansTISS:contratadoExecutante');
            $contratadoExecutante->addChild('ansTISS:codigoPrestadorNaOperadora', $guia->codigo_operadora_contratado);
            $contratadoExecutante->addChild('ansTISS:nomeContratado', $guia->contratado->nome); // Exemplo, substituir pelo valor real
            $contratadoExecutante->addChild('ansTISS:CNES', $guia->contratado->cnes);

            // Profissional Executante
            $profissionalExecutante = $guiaConsulta->addChild('ansTISS:profissionalExecutante');
            $profissionalExecutante->addChild('ansTISS:nomeProfissional', $guia->profissional->nome);
            $profissionalExecutante->addChild('ansTISS:conselhoProfissional', ltrim($guia->profissional->conselho->codigo_termo, '0'));
            $profissionalExecutante->addChild('ansTISS:numeroConselhoProfissional', $guia->profissional->conselho->codigo_termo);
            $profissionalExecutante->addChild('ansTISS:UF', $guia->uf_conselho_profissional);
            $profissionalExecutante->addChild('ansTISS:CBOS', $guia->cbo_s);

            // Indicação de Acidente e Dados do Atendimento
            $guiaConsulta->addChild('ansTISS:indicacaoAcidente', $guia->indicador_acidente);

            $dadosAtendimento = $guiaConsulta->addChild('ansTISS:dadosAtendimento');
            $dadosAtendimento->addChild('ansTISS:dataAtendimento', $guia->data);
            $dadosAtendimento->addChild('ansTISS:tipoConsulta', $guia->tipo_consulta);
            $procedimento = $dadosAtendimento->addChild('ansTISS:procedimento');
            $procedimento->addChild('ansTISS:codigoTabela', $guia->tabela);
            $procedimento->addChild('ansTISS:codigoProcedimento', $guia->procedimento->codigo);
            $procedimento->addChild('ansTISS:valorProcedimento', $guia->valor);

        }

        // Epílogo
        $epilogo = $xml->addChild('ansTISS:epilogo');
        $xmlContent = $xml->asXML();

        $hashValue = hash('md5', $xmlContent);

        $epilogo->addChild('ansTISS:hash', $hashValue);

        // Formata o XML para saída
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $xmlString = $dom->saveXML();

        return $xmlString;
    }
}
