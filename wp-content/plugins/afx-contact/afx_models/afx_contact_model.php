<?php
class AFX_Contact_Model {
    var $wpdb;
    var $table_name;
    var $totalResults;
    var $contact_id;
    var $email_from;
    var $email_to;
    var $email_bcc;
    var $subject;
    var $content;
    var $date;
    var $response;    
    
    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix."afx_contact";
    }
    
    public function getByContactId($contact_id) {
        $args = array(
            'contact_id' => $contact_id,
        );
        return $this->getOrders($args);
    }
    
    public function getContacts($args) {
        $args = esc_sql($args);
        
        $query = array();
        $order = "date desc";
        $limit = "";
        $join = "";
        
        if(isset($args['contact_id'])) $query[] = "c.contact_id={$args['contact_id']}";
        if(isset($args['search'])) $query[] = "(c.contact_from like '%{$args['search']}%' or c.email_to like '%{$args['search']}%' or c.email_bcc like '%{$args['search']}%')";
        if(isset($args['date_from'])) $query[] = "c.date >= '".$this->formatDate($args['date_from'])."'";
        if(isset($args['date_to'])) $query[] = "c.date <= '".$this->formatDate($args['date_to'])."'";
        
        if(count($query)>0) $query_str = " where ".implode(" and ", $query);
        else $query_str = "";
         
        $q = "";
        $rows = $this->wpdb->get_results("SELECT c.* FROM {$this->table_name} c {$join} {$query_str}  order by {$order}{$limit}");
        $this->totalResults = $this->wpdb->num_rows;
        
        return $this->prepareResults($rows);
    }
    
    public function formatDate($date,$sql = false) {
        $date = str_replace('/', '-', $date);
        if($sql) return date("d/m/Y",strtotime($date));
        else return date("Y-m-d",strtotime($date));
    }
    
    public function prepareResults($rows) {
        $results = array();
        foreach($rows as $row) {
            $result = new AFX_Contact_Model();
            $result->contact_id = $row->contact_id;
            $result->email_from = $row->email_from;
            $result->email_to = $row->email_to;
            $result->email_bcc = $row->email_bcc;
            $result->subject = $row->subject;
            $result->content = $row->content;
            $result->date = $row->date;
            $result->response = $row->response;
            $results[] = $result;
        }
        return $results;
    }
    
    public function delete($contact_id) {
        //User args here to delete by event and post
        return $this->wpdb->query( $this->wpdb->prepare( "DELETE FROM {$this->table_name} WHERE contact_id = %d",$contact_id ) );        
    }
    
    public function save($data = false) {
        if($data === false) {
            $data = array(
                'email_from' => $this->email_from,
                'email_to' => $this->email_to,
                'email_bcc' => $this->email_bcc,
                'subject' => $this->subject,
                'content' => $this->content,
                'response' => $this->response,
           );
       }
       $rows_affected = false;
       if(!empty($this->contact_id)) {
            //Update            
            $rows_affected = $this->wpdb->update( $this->table_name, $data, array( 'contact_id' => $this->contact_id ) );
        } else {
            //Create
            $rows_affected = $this->wpdb->insert( $this->table_name, $data );
            $this->order_id = $this->wpdb->insert_id;            
        }
        
        return $rows_affected;
    }
}