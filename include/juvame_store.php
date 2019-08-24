<?php 
class carrito {
	/***** atributos de la clase *****/
   	var $num_productos;
	var $array_pcod;
   	var $array_pnom;
   	var $array_pimg;
	var $array_pmon;
	var $array_pcan;
	var $array_puni;
	var $array_ppre;
	var $array_pres;
	
	
	function carrito ()
	 {
   		$this->num_productos=0;
		$this->totaldocumento=0;
		$this->numpedido="";
		$this->cliente_codigo = "";
		$this->cliente_nombre = "";
		$this->cliente_email  = "";
		$this->cliente_tele   = "";
		
	}
	function introduce_producto($pcod,$pnom,$pimg,$pmon,$pcan,$puni,$ppre,$pres)
	{
		$i=0;
		$encontrado=false;
		while ($i<=$this->num_productos && !$encontrado)
		{
			if ($this->array_pcod[$i]==$pcod)
			{
				$this->array_pcan[$i] += $pcan;
				$encontrado=true;
			}
			$i++;
		}
		if ($encontrado==false)
		{
			$this->array_pcod[$this->num_productos]=$pcod;
			$this->array_pnom[$this->num_productos]=$pnom;
			$this->array_pimg[$this->num_productos]=$pimg;
			$this->array_pmon[$this->num_productos]=$pmon;
			$this->array_pcan[$this->num_productos]=$pcan;
			$this->array_puni[$this->num_productos]=$puni;
			$this->array_ppre[$this->num_productos]=$ppre;
			$this->array_pres[$this->num_productos]=$pres;
			
			$this->num_productos++;
		}
	}
	function imprime_carrito(){
		$suma = 0;
		include "juvame_store.cart.php";
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
			if (isset($_POST[DEL.$this->array_pcod[$i]])) 
			{
				unset($this->array_pcod[$i]);
				unset($this->array_pnom[$i]);
				unset($this->array_pimg[$i]);
				unset($this->array_pmon[$i]);
				unset($this->array_pcan[$i]);
				unset($this->array_puni[$i]);
				unset($this->array_ppre[$i]);
				unset($this->array_pres[$i]);
				
				$numitem = $numitem-1;
			} 
		} //fin for
		$this->num_productos =$numitem;
		$this->array_pcod = array_values($this->array_pcod);
		$this->array_pnom = array_values($this->array_pnom);
		$this->array_pimg = array_values($this->array_pimg);
		$this->array_pmon = array_values($this->array_pmon);
		$this->array_pcan = array_values($this->array_pcan);
		$this->array_puni = array_values($this->array_puni);
		$this->array_ppre = array_values($this->array_ppre);
		$this->array_pres = array_values($this->array_pres);
		
	} //fin funtion updatecart
	
	/********* Envio de cotizaciones ************/
	function mail_cotizacion($codempresa,$nro_cotizacion) {
		include "juvame_store.mail.php";
		return $str;
	}
	/********** Registra la cotizacion en BD **************/
	function save_pedido($comenta,$empresa,$url,$rubro,$pagina) 
	{
		if ($this->num_productos > 0 )
		{
			$nrodoc = "D".date('ymdHis').codigo_azar(7);
			$this->numpedido = $nrodoc;
			$sql_doc = "INSERT INTO documento (
						   ccoddocumento,ccodpage,ccodcliente,cestdocumento,dfecdocumento,ccodmoneda,nmondocumento,cdesdocumento,curlcliente,crubcliente,cnomempresa) 
						   VALUES ('".$nrodoc."','".$pagina."','".$_SESSION['usuario_id']."','1',NOW( ),'D','".$this->totaldocumento."','".$comenta."','".$url."','".$rubro."','".$empresa."')";
			db_query($sql_doc);
			for ($i=0;$i<$this->num_productos;$i++)
			{
						$sqlr1 = "INSERT INTO documentodetalle (ccoddocumento,ccodcontenido,cnomunidad,ncantidad,nprecio) 
						VALUES ('".$nrodoc."','".$this->array_pcod[$i]."','".$this->array_puni[$i]."','".$this->array_pcan[$i]."','".$this->array_ppre[$i]."')";
						db_query($sqlr1);
			} 
			include "juvame_store.mail.php";
			include "juvame_store.ver.php";
			$_SESSION['ocarrito']->vaciar_carrito();
			return $nrodoc;
		}
		else
		{	
			$mensajeerror ="Su cesta de pedidos esta vacia, agregue productos";
			$suma = 0;
			include "juvame_store.cart.php";
		}
	}
	function save_pedidocliente($nombre,$email,$telefono,$comenta,$empresa,$url,$rubro,$pagina) 
	{
		
		if ($this->num_productos > 0 )
		{
			if (ltrim($nombre)<>"" and ltrim($email)<>"" and ltrim($telefono)<>"")
			{
				$sqlcliente = db_query("SELECT * FROM persona WHERE cemapersona ='".$email."' ");
				$totalexiste = db_num_rows($sqlcliente);
				if ($totalexiste=='0')
				{
					$sqlcad     = db_query("SELECT MAX(ccodpersona)+1 FROM persona");
					list($new_cod) = mysql_fetch_array($sqlcad);
					if(!isset($new_cod))	$new_cod='11061213';
					$nvopass = generar_password (6);
					$sql_insert= "INSERT INTO persona(
						ccodpersona,cnompersona,cemapersona,cpaspersona,cnivpersona,cestpersona,cestsuscripcion,
						csexpersona,dnacpersona,cimgpersona,ccodubigeo,cciudad,ccodidioma,ntelefono,
						nvispersona,ccodautenticacion,dfecpersona)	
					VALUES (
					'".$new_cod."',
					'".$nombre."',
					'".$email."',
					'".md5($nvopass)."',
					'1',
					'1',
					'0',
					'M',
					'1972-11-06',
					'hnohayfoto.jpg',
					'PE000000',
					'',
					'es',
					'".$telefono."',
					'0',
					'',
					now())";
					$query = db_query($sql_insert);
					$this->cliente_codigo = $new_cod;
					$this->cliente_nombre = $nombre;
					$this->cliente_email  = $email;
					$this->cliente_tele   = $telefono;
			
					$nrodoc = "D".date('ymdHis').codigo_azar(7);
					$this->numpedido = $nrodoc;
					$sql_doc = "INSERT INTO documento (
										   ccoddocumento,ccodpage,ccodcliente,cestdocumento,dfecdocumento,ccodmoneda,nmondocumento,cdesdocumento,curlcliente,crubcliente,cnomempresa) 
										   VALUES ('".$nrodoc."','".$pagina."','".$this->cliente_codigo."','1',NOW( ),'D','".$this->totaldocumento."','".$comenta."','".$url."','".$rubro."','".$empresa."')";
					db_query($sql_doc);
					for ($i=0;$i<$this->num_productos;$i++)
					{
						$sqlr1 = "INSERT INTO documentodetalle (ccoddocumento,ccodcontenido,cnomunidad,ncantidad,nprecio) 
						VALUES ('".$nrodoc."','".$this->array_pcod[$i]."','".$this->array_puni[$i]."','".$this->array_pcan[$i]."','".$this->array_ppre[$i]."')";
						db_query($sqlr1);
					} 
					include "juvame_store.mail.php";
					include "juvame_store.ver.php";
					$_SESSION['ocarrito']->vaciar_carrito();
					return $nrodoc;
				}
				else
				{
					$mensajeerror ="Email ya esta registrado por favor inicie session";
				}
			}
			else
			{
				$mensajeerror ="Datos incompletos debe Ingresar un nombre, email y telefono validos";
			}
		}
		else
		{
			$mensajeerror ="Su cesta de pedidos esta vacia, agregue productos";
		}
		$suma = 0;
		include "juvame_store.cart.php";
	}
	
}

session_start();
if (!isset($_SESSION['ocarrito']))
{
	$_SESSION['ocarrito'] = new carrito;
}
if (!isset($_SESSION['CONTADOR'])) 
{
	$_SESSION['CONTADOR']='0';
}
if (!isset($_SESSION['buscacontenido'])) 
{
	$_SESSION['buscacontenido']='';
}

?>