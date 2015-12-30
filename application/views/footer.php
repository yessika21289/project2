<?php
	$this->load->model('ypki');
	$kontak = $this->ypki->getKontak($instansi);
?>
<?php if(!empty($kontak)): ?>
	<footer>
		TELEPON KANTOR <?php echo strtoupper($instansi); ?> MAGELANG : <?php echo $kontak[0]->telepon1; ?> | EMAIL : <?php echo $kontak[0]->email; ?>
	</footer>
<?php else: ?>
	<footer>
		TELEPON KANTOR YPKI MAGELANG : (0293) 5573950 | EMAIL : SEKRETARIAT@YPKI.OR.ID
	</footer>
<?php endif; ?>
</div>

</body>
</html>