<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ranking_model extends CI_Model {

    // TABELA
    var $tabela = 'ranking';

    // ORDEM DAS COLUNAS
    // DEFINIR A ORDEM DAS COLUNAS DE ACORDO COM O BANCO DE DADOS
    var $ordem_colunas = array('nome', 'pontuacao');

    // COLUNAS PARA BUSCA
    // CAMPOS DE PESQUISA DA TABELA
    var $pesquisa_colunas = array('nome', 'pontuacao');

    // ORDEM PADRÃO
    var $ordem_padrao = array('nome' => 'asc');

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
                    $this->db->group_end(); //close bracket
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

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_active() {
        $this->db->from($this->tabela);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all() {
        $this->db->from($this->tabela);
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->from($this->tabela);
        $this->db->where('nome', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($nome, $pontos) {

        $query = "INSERT INTO ranking (nome, pontos)
                  VALUES ('$nome', $pontos)
                      ON CONFLICT (nome) DO UPDATE
                     SET pontos = EXCLUDED.pontos";

        if($this->db->query($query))
            return true;
        else
            return false;

    }

    public function update($where, $data) {
        $this->db->update($this->tabela, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
        $this->db->where('nome', $id);
        $this->db->delete($this->tabela);
    }

    public function get_ranking() {

        $query = "select rank() over(order by pontos desc, nome asc) rkg,
                         nome,
                         pontos
                    from ranking
                   order by pontos desc, nome asc";

        return $this->db->query($query)->result();
    }

}