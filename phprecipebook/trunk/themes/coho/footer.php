	</td>
</tr>
<tr>
	<td>
		<?php
			if ($SMObj->isSecureLogin())
				$SMObj->getLoginForm(NULL,"./index.php?m=admin&a=account");
		?>
	</td
</tr>

</table>
<?php
	$DB_LINK->Close();
?>
</center>
</font>
</body>
</html>
