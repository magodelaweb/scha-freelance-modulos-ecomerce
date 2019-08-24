<?php
    class conexionClass{
        var $conn;
        var $rs;
        var $v7;
        function __construct(){//function conexionClass(){  //en php 5
        	$this->v7=false;
        	if (!function_exists("mysql_pconnect")){
        		$this->v7=true;
			    $this->conn=mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME) or die ("No conectado - Error: ".mysqli_error());
			    //mysqli_select_db(DB_NAME,$this->conn);
			}
			else{
				$this->conn = mysql_pconnect(DB_HOST, DB_USER, DB_PASS) or die ("No conectado - Error: ".mysql_error());
				mysql_select_db(DB_NAME,$this->conn);
			}
            return $this->conn;
        }
        function consulta($sql){
        	if ($this->v7){
        		$this->rs=$this->conn->query($sql);
        	}
        	else{
        		$this->rs=mysql_query($sql,$this->conn);
        	}
            if(!$this->rs){
				$this->error($sql);
				die("error");
            }else{
                return $this->rs;
            }
        }
		function getConex(){
		 return $this->conn;
		}
		function insert_id(){
			if ($this->v7){
	    		return mysqli_insert_id($this->conn);
	    	}
	    	else{
	    		return mysql_insert_id($this->conn);
	    	}
		}
        function respuesta(){
        	if ($this->v7){
	    		return mysqli_fetch_array($this->rs);
	    	}
	    	else{
	    		return mysql_fetch_array($this->rs);
	    	}
        }
        function filas(){
        	if ($this->v7){
	    		return mysqli_num_rows($this->rs);
	    	}
	    	else{
	    		return mysql_num_rows($this->rs);
	    	}
        }
		function campos(){
			if ($this->v7){
	    		return mysqli_num_fields($this->rs);
	    	}
	    	else{
	    		return mysql_num_fields($this->rs);
	    	}
        }
		function liberar(){
			if ($this->v7){
	    		return mysqli_free_result($this->$rs);
	    	}
	    	else{
	    		return mysql_free_result($this->$rs);
	    	}
		}
		function cerrar(){
			if ($this->v7){
	    		return mysqli_close($this->rs);
	    	}
	    	else{
	    		return mysql_close($this->rs);
	    	}
        }
		function error($sql){
			$mysql_errno;
			$mysql_error;
			if ($this->v7){
		    	$mysql_errno = mysqli_errno();
			    $mysql_error = mysqli_error();
		    }
	    	else{
	    		$mysql_errno = mysql_errno();
			    $mysql_error = mysql_error();
	    	}
	    	echo("<b>Falló Consulta</b>
			   <br><br><b>Archivo: </b> ".__FILE__.
			   "<br><b>Linea: </b> ".__LINE__.
			   "<br><b>Nro. Mensaje Error: </b> " . $mysql_errno .
			   "<br><b>Mensaje: </b><br> " . $mysql_error .
			   "<br><b>Consulta: </b><br> $sql ");
		 exit();
		}
    }
?>
