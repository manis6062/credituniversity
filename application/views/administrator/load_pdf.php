
<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo ucfirst($title); ?>
            <small>list</small>
            <?php if ($role != CLIENT): ?>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/content/contentPdfForm'; ?>">Add Content</a>
            <?php endif ; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title ?></li>
        </ol>
    </section>
    <section class="content">


            <div class="box-body">

                <div class="form-group  col-md-12" style="color: white;">
                    <strong>Short Title :  </strong> <?php echo $pdf_books->short_name ?>
                    <div class="clearfix " style="margin-top: 15px;"></div>
                    <strong>Title :  </strong> <?php echo $pdf_books->name ?>
                    <div class="clearfix " style="margin-top: 15px;"></div>
                    <?php if(!empty($pdf_books->description)) : ?>
                    <strong>Description:</strong>   <?php echo $pdf_books->description ;?>
                    <?php endif ; ?>
                </div>
                <div class="form-group  col-md-12" style="color: white;">
                    <object data="<?php echo base_url('uploads/pdf_content/' . $pdf_books->file) ?>" height="800px" width="100%">
                        <p style="color: white;">Your web browser doesn't have a PDF Plugin. Instead you can <a href="http://partners.adobe.com/public/developer/en/acrobat/PDFOpenParameters.pdf"> Click
                                here to download the PDF</a></p>
                    </object>
                </div>
            </div>
        </div>
    </section>
</div>
