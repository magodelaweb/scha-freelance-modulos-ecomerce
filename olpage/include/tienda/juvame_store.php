<?php
class carrito {
	/***** atributos de la clase *****/
   	var $num_productos;
	var $array_productocod;
   	var $array_productonom;
   	var $array_productoimg;
	var $array_unidadcod;
	var $array_unidadnom;
	var $array_unidadpre;
	var $array_unidadcan;
	function carrito ()
	 {
   		$this->num_productos=0;
		$this->customer_id="";
		$this->customer="";
		$this->totaldocumento=0;
	}
	function introduce_producto($productocod,$productonom,$productoimg,$unidadcod,$unidadnom,$unidadpre,$unidadcan)
	{
		$i=0;
		$encontrado=false;
		while ($i<=$this->num_productos && !$encontrado)
		{
			if (($this->array_productocod[$i]==$productocod) and ($this->array_unidadcod[$i]==$unidadcod))
			{
				$this->array_unidadcan[$i] +=$unidadcan;
				$encontrado=true;
			}
			$i++;
		}
		if ($encontrado==false)
		{
			$this->array_productocod[$this->num_productos]=$productocod;
			$this->array_productonom[$this->num_productos]=$productonom;
			$this->array_productoimg[$this->num_productos]=$productoimg;
			$this->array_unidadcod[$this->num_productos]  =$unidadcod;
			$this->array_unidadnom[$this->num_productos]  =$unidadnom;
			$this->array_unidadpre[$this->num_productos]  =$unidadpre;
			$this->array_unidadcan[$this->num_productos]  =$unidadcan;
			$this->num_productos++;
		}
	}
	function imprime_carrito(){
		$suma = 0;
		include "juvame_store.print.php";
	}
	function vaciar_carrito()
	{
		if (isset($_SESSION['ocarrito']))
		{
			unset($_SESSION['ocarrito']);
			$_SESSION['ocarrito'] = new carrito;
		}
	}

	function error(){ 
      //  return $this->e_rror = mysql_error(); 
    }
	function updatecart() 
	{
		$numitem=$this->num_productos;
		for ($i=0;$i<$this->num_productos;$i++){
			if (isset($_POST[DEL.$this->array_unidadcod[$i]])) 
			{
				unset($this->array_productocod[$i]);
				unset($this->array_productonom[$i]);
				unset($this->array_productoimg[$i]);
				unset($this->array_unidadcod[$i]);
				unset($this->array_unidadnom[$i]);
				unset($this->array_unidadpre[$i]);
				unset($this->array_unidadcant[$i]);
				$numitem = $numitem-1;
			} 
			else 
			{
				if (isset($_POST[CANT.$this->array_unidadcod[$i]])) 
				{
					$this->array_unidadcan[$i] = $_POST[CANT.$this->array_unidadcod[$i]];
				}
			} //fin if
		} //fin for
		$this->num_productos =$numitem;
		$this->array_productocod = array_values($this->array_productocod);
		$this->array_productonom = array_values($this->array_productonom);
		$this->array_productoimg = array_values($this->array_productoimg);
		$this->array_unidadcod   = array_values($this->array_unidadcod);
		$this->array_unidadnom   = array_values($this->array_unidadnom);
		$this->array_unidadpre   = array_values($this->array_unidadpre);
		$this->array_unidadcan   = array_values($this->array_unidadcan);
	} //fin funtion updatecart
	
	/********* Envio de cotizaciones ************/
	function mail_cotizacion($codempresa,$nro_cotizacion) {
		include "juvame_store.mail.php";
		return $str;
	}
	/********** Registra la cotizacion en BD **************/
	function save_pedido($codempresa,$tipo) {
		
		$nrodoc = "D".date('ymdHis').codigo_azar(7);
		$sql_doc = "INSERT INTO documento (
										   ccoddocumento,
										   ccodpage,
										   ccodcliente,
										   cestdocumento,
										   dfecdocumento,
										   ccodmoneda,
										   nmondocumento) 
										   VALUES ('".$nrodoc."',' ','".$_SESSION['webuser_id']."','1',NOW( ),'','".$this->totaldocumento."')";
		db_query($sql_doc);
		/***************************************************/
		for ($i=0;$i<$this->num_productos;$i++)
		{
			if (isset($this->array_productocod[$i])) 
			{
				$sql_docdet = "INSERT INTO documentodetalle (ccoddocumento,ccodcontenido,ccodunidad,ncantidad,nprecio,cestado) 
				VALUES ('".$nrodoc."','".$this->array_productocod[$i]."','".$this->array_unidadcod[$i]."','".$this->array_unidadcan[$i]."','".$this->array_unidadpre[$i]."','1')";
				db_query($sql_docdet);
			} //fin if
		} //fin for
		/****************************************************/
		include "juvame_store.ver.php";
		$_SESSION['ocarrito']->vaciar_carrito();
		return $nrodoc;
	}
}
session_start();
if (!isset($_SESSION['ocarrito']))
{
	$_SESSION['ocarrito'] = new carrito;
}
if (empty($_SESSION['CONTADORESTADO'])) 
{
	$_SESSION['CONTADORESTADO']='0';
}
?>