<?php
/**
 * @connect_module_class_name ArsenalpayMk
 * @package DynamicModules
 * @subpackage Payment
 */
	class ArsenalpayMk extends PaymentModule {

		var $type = PAYMTD_TYPE_ONLINE;
		var $language = 'rus';
		var $default_logo = './images_common/payment-icons/arsenalpay.gif';
		


	function _initVars(){

		parent::_initVars();
		$this->title 		= "Arsenalpay.ru | Оплата со счета мобильного телефона";
		$this->description 	= 'Платежная система Arsenalpay | Оплата со счета мобильного телефона<br>ВНИМАНИЕ: Для работы модуля необходимо произвести регистрацию и получить ключи на сайте <a href="https://arsenalpay.ru>Arsenalpay</a>" ';
		$this->sort_order 	= 0;
		$this->Settings = array(
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_TOKEN", 
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_TESTMODE",
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_PAYMENTS_DESC",
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_SHARED_SECRET",
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_ORDERSTATUS",
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_WIDTH",
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_HEIGHT",
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_BORDER",
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_SCROLLING",
				"CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_CSS",
		);
	}

	function _initSettingFields(){

		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_TOKEN'] = array(
			'settings_value' 		=> '', 
			'settings_title' 			=> 'Токен, используемый для идентификации в платежной системе Arsenalpay', 
			'settings_description' 	=> 'Формат - 32 символа (буквы и цифры)', 
			'settings_html_function' 	=> 'setting_TEXT_BOX(0,', 
			'sort_order' 			=> 1,
		);

		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_TESTMODE'] = array(
			'settings_value' 		=> '', 
			'settings_title' 			=> 'Тестовый режим', 
			'settings_description' 	=> 'Используйте тестовый режим для проверки модуля', 
			'settings_html_function' 	=> 'setting_CHECK_BOX(', 
			'sort_order' 			=> 1,
		);
		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_PAYMENTS_DESC'] = array(
			'settings_value' 		=> 'Оплата заказа #[orderID]', 
			'settings_title' 			=> 'Назначение платежей', 
			'settings_description' 	=> 'Укажите описание платежей. Вы можете использовать строку [orderID] - она автоматически будет заменена на номер заказа', 
			'settings_html_function' 	=> 'setting_TEXT_BOX(0,', 
			'sort_order' 			=> 1,
		);
		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_SHARED_SECRET'] = array(
			'settings_value' 		=> '',
			'settings_title' 			=> 'Secret Key',
			'settings_description' 	=> 'Строка символов, добавляемая к реквизитам платежа, высылаемым продавцу вместе с оповещением. Эта строка используется для повышения надежности идентификации высылаемого оповещения. Содержание строки известно только сервису Web Merchant Interface и продавцу',
			'settings_html_function' 	=> 'setting_TEXT_BOX(0,',
			'sort_order' 			=> 1,
		);
		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_ORDERSTATUS'] = array(
			'settings_value' 		=> '-1',
			'settings_title' 			=> 'Статус заказа',
			'settings_description' 	=> 'Статус, который будет автоматически установлен для заказа после успешной оплаты',
			'settings_html_function' 	=> 'setting_SELECT_BOX(PaymentModule::_getStatuses(),',
			'sort_order' 			=> 1,
		);
		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_WIDTH'] = array(
			'settings_value' 		=> '740',
			'settings_title' 			=> 'Ширина фрейма платежной системы в пикселях',
			'settings_description' 	=> 'Зависит от стиля оформления. Рекомендуемое значение для стиля по умолчанию: 600 и более',
			'settings_html_function' 	=> 'setting_TEXT_BOX(0,',
			'sort_order' 			=> 1,
		);		
		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_HEIGHT'] = array(
			'settings_value' 		=> '600',
			'settings_title' 			=> 'Высота фрейма платежной системы в пикселях',
			'settings_description' 	=> 'Зависит от стиля оформления. Рекомендуемое значение для стиля по умолчанию: 500 и более',
			'settings_html_function' 	=> 'setting_TEXT_BOX(0,',
			'sort_order' 			=> 1,
		);
		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_BORDER'] = array(
			'settings_value' 		=> '',
			'settings_title' 			=> 'Граница фрейма',
			'settings_description' 	=> 'Отображение границы фрейма',
			'settings_html_function' 	=> 'setting_CHECK_BOX(',
			'sort_order' 			=> 1,
		);
		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_SCROLLING'] = array(
			'settings_value' 		=> '',
			'settings_title' 			=> 'Прокрутка содержимого фрейма',
			'settings_description' 	=> 'Параметр включает скролбар, необходимый для просмотра содержимого фрейам в случае если его размеры слишком малы',
			'settings_html_function' 	=> 'setting_SELECT_BOX(ArsenalpayMk::_getScrollState(),',
			'sort_order' 			=> 1,
		);
		//---------------------------------------------------------------------------
		$this->SettingsFields['CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_CSS'] = array(
			'settings_value' 		=> '',
			'settings_title' 			=> 'URL CSS файла с оформлением для содержимого фрейма',
			'settings_description' 	=> 'Подгруженный файл переопределит стиль офромления для элементов фрейма. (для стандартного стиля оформления оставьте поле пустым)',
			'settings_html_function' 	=> 'setting_TEXT_BOX(0,',
			'sort_order' 			=> 1,
		);
	}


function getCustomProperties()
	{
		$customProperties = array();
		$customProperties[] = array(
			'settings_title'=>'Callback. Адрес для получения ответов с результатом платежа',
			'settings_description'=>'Скопируйте этот адрес и предоставьте вашему менеджеру в ArsenalPay',
			'control'=>'<input type="text" onclick="this.select();" onfocus="this.select();" readonly="readonly" size="40" value="'
			.xHtmlSpecialChars($this->getDirectTransactionResultURL(null,null,true))
			.'">'
			);
			return $customProperties;
	}


	function after_processing_html( $orderID )
	{
		$order = ordGetOrder( $orderID );
		$order_amount = $order["order_amount"];


		$is_MSIE = (isset($_SERVER['HTTP_USER_AGENT'])&&(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false))?true:false;

		$res = "";

		$description = str_replace("[orderID]",$orderID,$this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_PAYMENTS_DESC'));
		if ( $is_MSIE) {
			$description = translit($description);
		}


			$pay_type='mk';
			$token=trim($this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_TOKEN'));

			$order_key=$this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_SHARED_SECRET');
			$hash_key=sha1(sha1($orderID).sha1($order_amount).sha1($token).sha1($order_key)); 
			$framecss=$this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_CSS');

			$frameborder=$this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_BORDER');
			$frameborder=' frameborder="'.$frameborder.'" ';


			$framescroll=$this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_SCROLLING');
			$framescroll=' scrolling="'.$framescroll.'" ';


			$url='https://arsenalpay.ru/payframe/pay.php?
			src='.$pay_type.
			'&t='.$token.
			'&n='.$orderID.
			'&a='.$order_amount.
			'&key='.$hash_key.
			'&css='.$framecss;


			$frame_w=trim($this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_WIDTH'));
			if($frame_w<200) $frame_w=200;
			$frame_h=trim($this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_FRAME_HEIGHT'));
			if($frame_h<200) $frame_h=200;

			$res .= '<br>
			<h3>'.$description.'</h3>
			<h3>Оплата со счета мобильного телефона</h3>

			<iframe src="'.$url.'"  width="'.$frame_w.'px" height="'.$frame_h.'px" '.$framescroll.' '.$frameborder.'>
			</iframe>';

		return $res;
	}

	function transactionResultHandler($transaction_result = '',$message = '',$source = 'frontend')
	{
		$log = '';

		if ( $source == 'handler' )
		{

			$ID = $_POST['ID'];
			$FUNCTION = $_POST['FUNCTION'];
			$RRN = $_POST['RRN'];
			$PAYER = $_POST['PAYER'];
			$AMOUNT = $_POST['AMOUNT'];
			$ACCOUNT = $_POST['ACCOUNT'];
			$STATUS = $_POST['STATUS'];
			$DATETIME = $_POST['DATETIME'];

			$KEY = $this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_SHARED_SECRET');

			if(isset($_POST['SIGN']) && $_POST['SIGN'] == md5(md5($ID).md5($FUNCTION).md5($RRN).md5($PAYER).md5($AMOUNT).md5($ACCOUNT).md5($STATUS).md5($KEY)) )
			{

				$function = isset($_POST['FUNCTION']) ? $_POST['FUNCTION'] : 0;

				if ( $function && ($function=='check') )
				{
					$orderID = isset($_POST['ACCOUNT']) ? $_POST['ACCOUNT'] : 0;

					if (  $orderID && ($order = _getOrderById($orderID)) )
					{
						$order_amount = $order['order_amount'];
						if( $order_amount == $AMOUNT)
						{

							$log = "Order with id {$orderID} check";
							$transaction_result = 'YES';
						}
						else
						{
							$AMOUNT = $AMOUNT.'.00';

							$log = "Order  {$orderID} amount mismatch with callback. {$AMOUNT}  in callback vs {$order_amount} in db";
							$orderID = false;
							$transaction_result = 'NO';
						}
					}
					else
					{
						$log = "Order with id {$orderID} not exists";
						$orderID = false;
						$transaction_result = 'NO';
					}

				}
				elseif ( $function && ($function=='payment') )
				{
					$orderID = isset($_POST['ACCOUNT']) ? $_POST['ACCOUNT'] : 0;

					if (  $orderID && ($order = _getOrderById($orderID)) )
					{
						$order_amount = $order['order_amount'];
						if( $order_amount == $AMOUNT)
						{
							$log = "Order with id {$orderID} PAYMENT recieved";
							$transaction_result = 'OK';
							$statusID = $this->_getSettingValue('CONF_PAYMENTMODULE_ARSENALPAY_MK_ORDERSTATUS');
							if($statusID!=-1){
								$comment = $sys_invs_no?sprintf("Заказ оплачен по Webmoney%s. Номер счета — %s, номер платежа — %s.",($mode?' (тестовый режим)':''),$sys_invs_no,$sys_trans_no):'Заказ оплачен по WebMoney';
								ostSetOrderStatusToOrder( $orderID, $statusID,$comment,0,true);
							}
						}
						else
						{
							$AMOUNT = $AMOUNT.'.00';

							$log = "Order  {$orderID} amount mismatch with callback. {$AMOUNT}  in callback vs {$order_amount} in db";
							$orderID = false;
							$transaction_result = 'ERR';
						}
					}
					else
					{
						$log = "Order with id {$orderID} not exists";
						$orderID = false;
						$transaction_result = 'ERR';
					}
				}
				else
				{

					$log = "Failed ARSENAL PAY callback call";
					$orderID = false;
					$transaction_result = 'ERR';
				}
			}
			else
			{

				$log = "ARSENAL PAY sign fail";
				$orderID = false;
				$transaction_result = 'ERR';
			}

		

		
		$responce = $transaction_result ;
		echo $responce;
		return parent::transactionResultHandler($transaction_result,$message.$log,$source);
		}

	}

	public static function _getScrollState()
	{
		$fields = array("Авто"=>"auto", "Да" => "yes", "Нет" =>"no");
		$res = array();
		foreach($fields as $field => $val){
			$res[] = xHtmlSpecialChars($field.':'.$val);
		}
		return implode(',',$res);
	}
}
?>