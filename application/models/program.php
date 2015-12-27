<?php

class Program extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->allowed_tags = '<p><div><br><span><strong><em><sub><sup><ul><ol><li><a><blockquote><iframe>';
    }

    public function getAllProgram() {
        $program = array();
        $query = $this->db->get('program');
        $results = $query->result();
        foreach($results as $result) {
            $program[$result->instansi] = $result->aktif;
        }
        return $program;

    }

    public function getProgram($instansi) {
        $this->db->where('instansi', $instansi);
        $query = $this->db->get('program');
        return $query->result();
    }

    public function addProgram($instansi, $post) {
        $program_aktif = !empty($post['program_aktif']) ? $post['program_aktif'] : 0;
        $this->db->insert('program',
            array(
                'program' => $post['program'],
                'instansi' => $instansi,
                'aktif' => $program_aktif
            ));
        return true;
    }

    public function updateProgram($instansi, $post) {
        $program_aktif = !empty($post['program_aktif']) ? $post['program_aktif'] : 0;
        $this->db->where('instansi', $instansi);
        $this->db->update('program',
            array(
                'program' => $post['program'],
                'aktif' => $program_aktif,
            ));
        return true;
    }



}

?>