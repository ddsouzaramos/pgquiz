<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class respostas_model extends CI_Model {

    // TABELA
    var $tabela = 'respostas';

    // ORDEM DAS COLUNAS
    // DEFINIR A ORDEM DAS COLUNAS DE ACORDO COM O BANCO DE DADOS
    var $ordem_colunas = array('id_resposta', 'descricao');

    // COLUNAS PARA BUSCA
    // CAMPOS DE PESQUISA DA TABELA
    var $pesquisa_colunas = array('descricao');

    // ORDEM PADRÃO
    var $ordem_padrao = array('ordem' => 'asc');

    private function _get_datatables_query() {

        $this->db->from($this->tabela);

        $i = 0;

        foreach ($this->pesquisa_colunas as $item) {

            if($_POST['search']['value']) {

                if($i===0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->pesquisa_colunas) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if(isset($_POST['order'])) {
            $this->db->order_by($this->ordem_colunas[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->ordem_padrao)) {
            $order = $this->ordem_padrao;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function get_by_id_pergunta($id_pergunta) {
        $this->db->from($this->tabela);
        $this->db->where('id_pergunta', $id_pergunta);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->tabela);
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->from($this->tabela);
        $this->db->where('id_resposta', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data) {
        $this->db->insert($this->tabela, $data);
        return $this->db->affected_rows();
    }

    public function update($where, $data) {
        $this->db->update($this->tabela, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
        $this->db->where('id_resposta', $id);
        $this->db->delete($this->tabela);
    }

    public function get_last_ordem($id_pergunta) {
        $this->db->from($this->tabela);
        $this->db->where('id_pergunta', $id_pergunta);
        $this->db->select_max('ordem');
        $query = $this->db->get();

        if($query->row()->ordem == null)
            return 1;
        else
            return $query->row()->ordem + 1;
    }

}