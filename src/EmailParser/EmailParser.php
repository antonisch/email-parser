<?php

namespace EmailParser;

class EmailParser{

    private $connection;

    // inbox storage and inbox message count
    private $inbox;
    private $msg_cnt;

    // email login credentials
    private $server;
    private $user;
    private $pass;
    private $port;
    private $mode;

    public function __construct ($server,$user,$pass,$port,$mode = 'ssl'){

        $this->server = $server;
        $this->user   = $user;
        $this->pass   = $pass;
        $this->port   = $port;
        $this->mode   = $mode;

        $this->connect();

    }

    // Close connection
    function close() {

        $this->inbox = array();
        $this->msg_cnt = 0;
        imap_close($this->connection);

    }

    // Connect to the server
    function connect() {

        $this->connection = imap_open('{'.$this->server.":$this->port"."/$this->mode}", $this->user, $this->pass);

    }

    // Get unseen indexes
    public function getUnseenIndexes(){

        return imap_search($this->connection, 'UNSEEN');

    }

    // Get email
    public function getEmail($msg_index=NULL) {

        if (count($this->inbox) <= 0) {
            return array();
        }
        elseif ( $msg_index !== NULL && isset($this->inbox[$msg_index])) {
            return $this->inbox[$msg_index];
        }

        return $this->inbox[0];
    }

    // Move email to another inbox
    public function move($msg_index, $folder='INBOX.Processed') {

        imap_mail_move($this->connection, $msg_index, $folder);
        imap_expunge($this->connection);

    }

    public function getInbox() {

        $this->msg_cnt = imap_num_msg($this->connection);

        $in = array();
        for($i = 1; $i <= $this->msg_cnt; $i++) {
            $in[] = array(
                'index'     => $i,
                'header'    => imap_headerinfo($this->connection, $i),
                'body'      => imap_body($this->connection, $i),
                'structure' => imap_fetchstructure($this->connection, $i)
            );
        }

        $this->inbox = $in;
    }


}