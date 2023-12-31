<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?> <!-- Retorna todos los errores asociaciados al 
                                        form submission-->

<?php echo form_open('news/create'); ?> <!--Function provided by the form helper: renders 
                                            the form element and prevents CSRF attacks--> 

    <label for="title">Title</label>
    <input type="text" name="title" /><br />

    <label for="text">Text</label>
    <textarea name="text"></textarea><br />

    <input type="submit" name="submit" value="Create news item" />
<?php echo form_close(); ?>
