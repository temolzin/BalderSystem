<?php
  interface Crud {
    public function read();
    public function insert($data);
    public function delete($data);
    public function update($id);
  }
