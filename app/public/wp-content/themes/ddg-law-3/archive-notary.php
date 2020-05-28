<?php get_header(); ?>

<div class="notary-container ml-3 mr-3">

    <div class="row ml-0 mr-0 mb-4 rtl">

        <div class="">
            <h1 class="">אישורים נוטריונייים</h1>
        </div>

        <div class="col text-left">
            <button type="button" class="btn btn-primary btn-lg pl-5 pr-5 btn-open-modal" data-toggle="modal"
                data-target="#notaryModal" data-target=".bd-example-modal-xl">הוסף</button>
        </div>
    </div>

    <div class="table-responsive-sm table-responsive-md mb-5">

        <table class="table table-striped table-light table-hover table-dark rtl">

            <thead class="thead-dark">
                <tr>
                    <th scope="col">מס׳ סידורי</th>
                    <th scope="col">שם הלקוח</th>
                    <th scope="col">סוג האישור</th>
                    <th scope="col">תאריך האישור</th>
                    <th scope="col">שכר שנגבה</th>
                    <th scope="col">מסמכים</th>
                </tr>
            </thead>

            <div class="notary-list-container">
                <tbody id="tbody">

                    <?php 
        $notaryRecords = new WP_query(array(
            'post_type' => 'notary',
            'posts_per_page' => '-1',
            'order_by' => 'index_number',
            'order' => 'ASC',
            'meta_query' => array(
                'key' => get_field('userID'),
                'compare' => '=',
                'value' => get_current_user_id()
            ),
        ));

        if ($notaryRecords) {
            while ($notaryRecords -> have_posts ()) { 
                $notaryRecords -> the_post();?>
                    <tr data-id="<?php the_id(); ?>">
                        <th scope="row" id="index-number-field"><?php echo get_field('index_number') ?></th>
                        <td id="client-name-field"><?php echo get_field('client_name') ?></td>
                        <td data-id="<?php echo get_field('approval_kind') ?>" id="approval-kind-field">
                            <?php echo get_the_title(get_field('approval_kind')) ?> </td>
                        <td id="approval-date-field"><?php echo get_field('approval_date') ?></td>
                        <td id="price-field"> <?php echo get_field('price') ?> ש״ח</td>
                        <td>מסמכים</td>
                        <td>
                            <span class="trash-icon"><i class="fas fa-trash-alt"></i></span>
                            <span class="edit-icon"><i class="far fa-edit"></i></span>
                        </td>
                    </tr>
                </tbody>
                <?php }
                } ?>
            </div>
        </table>
    </div>

    <button type="button" class="btn btn-primary btn-lg pl-5 pr-5 btn-open-modal" data-target=".bd-example-modal-xl"
        data-toggle="modal" data-target="#notaryModal">הוסף</button>

</div>
<br class="mb-5">

<!-- Extra large modal -->

<div class="modal fade bd-example-modal-xl" data-id="0" id="notaryModal" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

        
        <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">הוספת רשומה נוטריונית</h4>

    </div>



            <form id="newNotaryForm" method="POST" class="rtl">

                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label">מס׳ סידורי</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="indexNumber" placeholder="מס׳ סידורי">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">שם הלקוח</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="clientName" placeholder="שם הלקוח">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-sm-4 col-form-label">סוג אישור</label>
                    <div class="col-sm-8">
                        <select class="custom-select form-control" id="approvalKind">
                            <option value="0" selected>בחר</option>
                            <?php 
                                $approvalKinds = new WP_query (array(
                                    'post_type' => 'approval_kind',
                                    'order' => 'ASC',
                                ));

                                if ($approvalKinds) {
                                    while ($approvalKinds -> have_posts()) {
                                        $approvalKinds -> the_post();?>
                            <option value="<?php the_id(); ?>"><?php the_title(); ?></option>
                            <?php }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">תאריך האישור</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="approvalDate" value="<?php echo date('Y-m-d') ?>"
                            placeholder="תאריך האישור">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">שכר שנגבה</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="price" placeholder="שכר שנגבה">
                    </div>
                </div>

                <div class="form-group row mt-5">

                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-lg btn-save">שמור</button>
                        <button type="button" class="btn btn-lg btn-danger mr-3 btn-close-modal"
                            data-dismiss="modal">בטל</button>
                    </div>

                    <div class="col-sm-8">
                        <form action="/users/upload-file" id="form-add-document" method="post"
                            enctype="multipart/form-data">
                            <button type="button" class="btn btn-success btn-lg mr-7 pl-5 pr-5" id="btn-add-document"
                                name="doc">הוסף מסמך</button>
                            <input type="file" id="fileChoozer" style="display:none">
                            <button type="submit" name="button" style="display:none" id="btn-upload-file"></button>
                        </form>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>