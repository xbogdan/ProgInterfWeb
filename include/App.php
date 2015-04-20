<?php
  class App {
    public function __construct(\PDO $dbh, $config=null)
    {
      $this->dbh = $dbh;
      // $this->config = $config;
      $this->config = new stdClass();

      $this->config->table_services = 'services';
      $this->config->table_services_type = 'services_types';
      $this->config->table_companies = 'companies';
      $this->config->table_reservations = 'reservations';
    }


    /*
    * Get list of all available services
    */
    public function getServices() {
      $query = $this->dbh->prepare("SELECT *, s.date AS 'service_date', s.description AS 'service_description', s.id AS 'service_id', s.name AS 'service_name', st.name AS 'service_type_name', c.name AS 'company_name' FROM {$this->config->table_services} AS s, {$this->config->table_services_type} AS st, {$this->config->table_companies} AS c WHERE s.service_type_id = st.id AND s.company_id = c.id AND active");
  		$query->execute();
      return $services = $query->fetchAll();
    }


    /*
    * Get service by id
    */
    public function getService($id) {
      $query = $this->dbh->prepare("SELECT *, s.id AS 'service_id', s.description AS 'service_description', s.name AS 'service_name', st.name AS 'service_type_name', c.name AS 'company_name' FROM {$this->config->table_services} AS s, {$this->config->table_services_type} AS st, {$this->config->table_companies} AS c WHERE s.service_type_id = st.id AND s.company_id = c.id AND s.id = ?");
  		$query->execute(array($id));
      return $services = $query->fetch();
    }


    /*
    * Reserve service
    */
    public function reserveService($service_id, $user_id, $quantity) {
      $query = $this->dbh->prepare("SELECT * FROM {$this->config->table_services} WHERE id = ?");
      $query->execute(array($service_id));
      if ($query->rowCount() == 0) return false;

      $query = $this->dbh->prepare("INSERT INTO {$this->config->table_reservations} (user_id, service_id, quantity) VALUES (?,?,?)");
      return $query->execute(array($user_id, $service_id, $quantity));
    }


    /*
    * Get users reservations
    */
    public function getReservations($user_id) {
      $query = $this->dbh->prepare("SELECT *, s.name AS 'service_name', s.description AS 'service_description', st.name AS 'service_type_name', c.name AS 'company_name' FROM {$this->config->table_reservations} AS r, {$this->config->table_services} AS s, {$this->config->table_services_type} AS st, {$this->config->table_companies} AS c WHERE r.service_id = s.id AND c.id = s.company_id AND s.service_type_id = st.id AND user_id = ?");
      $query->execute(array($user_id));

      return $query->fetchAll();
    }


    /*
    * Delete service
    */
    public function deleteService($id) {
      $query = $this->dbh->prepare("UPDATE {$this->config->table_services} SET active = 0 WHERE id = ?");
      return $query->execute(array($id));
    }

  }
