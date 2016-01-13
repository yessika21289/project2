<div id="content" xmlns="http://www.w3.org/1999/html">
    <div id="content-left">

    <?php
        $pesan_terkirim = !empty($this->session->flashdata('pesan_terkirim')) ? $this->session->flashdata('pesan_terkirim') : '';

        if($pesan_terkirim){
    ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong>Sukses!</strong> Pesan telah dikirim. Kami akan menghubungi Anda.
                </div>
            </div>
        </div>
    <?php }?>
        <div class='row' id='judul-daftar'>
            <div class='col-xs-12'>
				<span>
					Info Kontak - <?php echo strtoupper($instansi);?>
				</span>
            </div>
        </div>
        <?php if(!empty($kontak)):

            if(!empty($kontak->telepon1) && !empty($kontak->telepon2))
                $telepon = $kontak->telepon1.', '.$kontak->telepon2;
            else
                $telepon = !empty($kontak->telepon1) ? $kontak->telepon1 : $kontak->telepon2;

            if(!empty($kontak->alamat))
                echo '<span style="font-family: Arial; font-weight: bold; font-size: 15pt; color: #999; border-bottom: 1px groove;">ALAMAT</span>
                        <br/>'.$kontak->alamat.'<br/><br/>';
            if(!empty($telepon))
                echo '<i class="fa fa-phone"></i>' .$telepon. '<br/>';
            if(!empty($kontak->fax))
                echo '<i class="fa fa-fax"></i>' .$kontak->fax. '<br/>';
            if(!empty($kontak->email))
                echo '<i class="fa fa-envelope"></i>' .$kontak->email. '<br/>';
            if(!empty($kontak->website))
                echo '<i class="fa fa-globe"></i><a href="http://'.$kontak->website.'">' .$kontak->website. '</a><br/>';

            echo '<br/><br/><br/>';
        endif; ?>
        <?php $url = ($instansi == "ypki") ? "kontak" : $instansi."/kontak";?>
        <span style="font-family: Arial; font-weight: bold; font-size: 15pt; color: #999; border-bottom: 1px groove;">TINGGALKAN PESAN</span>
        <form role="form" action=" <?php echo base_url().$url; ?> " method="post">
            <div class="form-group">
              <label for="inputNama">Nama*</label>
              <?php if(!empty(form_error('nama'))){?>
              <div class="alert alert-danger alert-dismissible" role="alert"><?php echo form_error('nama'); ?></div>
              <?php }?>
              <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Nama" maxlength="255" value="<?php echo set_value('nama'); ?>">
            </div>
            <div class="form-group">
              <label for="inputEmail">Email*</label>
              <?php if(!empty(form_error('email'))){?>
              <div class="alert alert-danger alert-dismissible" role="alert"><?php echo form_error('email'); ?></div>
              <?php }?>
              <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" maxlength="255" value="<?php echo set_value('email'); ?>">
            </div>
            <div class="form-group">
              <label for="inputPhone">Nomor Telepon / Handphone</label>
              <?php if(!empty(form_error('phone'))){?>
              <div class="alert alert-danger alert-dismissible" role="alert"><?php echo form_error('phone'); ?></div>
              <?php }?>
              <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="Nomor Telepon / Handphone" maxlength="16" value="<?php echo set_value('phone'); ?>">
            </div>
            <div class="form-group">
              <label for="inputPesan">Pesan*</label>
              <?php if(!empty(form_error('pesan'))){?>
              <div class="alert alert-danger alert-dismissible" role="alert"><?php echo form_error('pesan'); ?></div>
              <?php }?>
              <textarea class="form-control" id="inputPesan" name="pesan" placeholder="Pesan" rows="10"><?php echo set_value('pesan'); ?></textarea>
            </div>
            <button type="submit" class="btn-login">KIRIM</button>
        </form>
        <div class="blank">
        </div>
    </div>



    <div id="content-right">

        <?php $this->load->view("div_login") ?>

        <?php $this->load->view("div_berita") ?>

        <?php $this->load->view("div_agenda") ?>

    </div>

    <div class="clear"></div>

</div>