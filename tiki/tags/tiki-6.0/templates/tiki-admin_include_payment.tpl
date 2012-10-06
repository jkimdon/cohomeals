{* $Id: tiki-admin_include_payment.tpl 29037 2010-09-08 18:53:29Z changi67 $ *}
<div class="navbar">
	 {button href="tiki-payment.php" _text="{tr}Payments{/tr}"}
</div>
<form action="tiki-admin.php?page=payment" method="post">
	<fieldset class="admin">
		<legend>{tr}Payment{/tr}</legend>
		{preference name=payment_feature}
		
		{remarksbox title="{tr}Choose payment system{/tr}"}
			{tr}You can only use one payment Paypal or Cclite or Tiki User Credits{/tr}<br />
			{tr}PayPal is working at the moment. See PayPal.com{/tr}<br />
			{tr}Cclite: Community currency accounting for local exchange trading systems (LETS). See {/tr}<a href="http://sourceforge.net/projects/cclite/">{tr}sourceforge.net{/tr}</a><br />
			{tr}Tiki User Credits: Requires this other feature to be configured{/tr}
		{/remarksbox}
		
		<div class="adminoptionboxchild" id="payment_feature_childcontainer">
			<fieldset class="admin">
				{preference name=payment_system}
				{preference name=payment_currency}
				{preference name=payment_default_delay}
				{preference name=payment_manual}
			</fieldset>
			<div id="payment_systems">
				<h2>{tr}PayPal{/tr}</h2>
				<div class="admin payment">
					{preference name=payment_paypal_business}
		
					<div class="adminoptionboxchild">
						{preference name=payment_paypal_environment}
						{preference name=payment_paypal_ipn}
					</div>
					{preference name=payment_invoice_prefix}
				</div>
				<h2>{tr}Cclite{/tr}</h2>
				<div class="admin payment">
					{remarksbox title="{tr}Experimental{/tr}" type="warning" icon="bricks"}
						{tr}Cclite is for creating and managing alternative or complementary trading currencies and groups{/tr}
						{tr}Work in progress for Tiki 6{/tr}
					{/remarksbox}
					{preference name=payment_cclite_registries}
					{preference name=payment_cclite_currencies}
					<div class="adminoptionboxchild">
						{preference name=payment_cclite_gateway}
						{preference name=payment_cclite_merchant_user}
						{preference name=payment_cclite_merchant_key}
						{preference name=payment_cclite_mode}
						{preference name=payment_cclite_hashing_algorithm}
						{preference name=payment_cclite_notify}
					</div>
				</div>
				<h2>{tr}Tiki User Credits{/tr}</h2>
				<div class="admin payment">
					{preference name=payment_tikicredits_types}
					{preference name=payment_tikicredits_xcrates}
				</div>
			</div>
		{jq}
if ($.ui) {
	var idx = $("select[name=payment_system]").attr("selectedIndex");
	$("#payment_systems").tiki("accordion", {heading: "h2"});
	if (idx > 0) { $("#payment_systems").accordion("option", "active", idx); }
}{/jq}
		</div>
	</fieldset>
	<fieldset>
		<legend>{tr}Shipping{/tr}</legend>
		{preference name=shipping_service}

		{preference name=shipping_fedex_enable}
		<div class="adminoptionboxchild" id="shipping_fedex_enable_childcontainer">
			{preference name=shipping_fedex_key}
			{preference name=shipping_fedex_password}
			{preference name=shipping_fedex_account}
			{preference name=shipping_fedex_meter}
		</div>

		{preference name=shipping_ups_enable}
		<div class="adminoptionboxchild" id="shipping_ups_enable_childcontainer">
			{preference name=shipping_ups_license}
			{preference name=shipping_ups_username}
			{preference name=shipping_ups_password}
		</div>
	</fieldset>
	<div class="heading input_submit_container" style="text-align: center">
		<input type="submit" name="faqcomprefs" value="{tr}Change settings{/tr}" />
	</div>
</form>