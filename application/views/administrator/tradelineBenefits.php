
<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo "Tradeline Benefits"; ?>
            <small>list</small>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/content/contentPdfForm'; ?>">Add Content</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo "Tradeline Benefits" ?></li>
        </ol>
    </section>
    <section class="content">


            <div class="box-body">

                <div class="form-group  col-md-12">
                    <strong>Title :</strong> Funding <?php echo $content->name ?>
                    <div class="clearfix " style="margin-top: 15px;"></div>
                    <strong>Description:</strong>   <?php echo $content->description ;?>

                </div>
                <div class="form-group  col-md-12">
                    <object data="<?php echo base_url('uploads/pdf_content/' . $content->file) ?>" height="800px" width="100%">
                        <p>Your web browser doesn't have a PDF Plugin. Instead you can <a href="http://partners.adobe.com/public/developer/en/acrobat/PDFOpenParameters.pdf"> Click
                                here to download the PDF</a></p>
                    </object>
                </div>
            </div>
        </div>
    </section>
</div>
