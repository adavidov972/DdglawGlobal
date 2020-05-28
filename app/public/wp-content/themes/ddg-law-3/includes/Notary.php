<?php

add_action('rest_api_init', 'notary_api_manage');

function notary_api_manage () {
    register_rest_route('notary/v1', 'manageNotary', array (
        'methods' => "POST",
        'callback' => 'manageNotaryCallback'
    ));

    register_rest_route('notary/v1', 'deleteNotary', array (
        'methods' => "DELETE",
        'callback' => 'deleteNotaryCallback'
    ));
}

function manageNotaryCallback ($data) {
    
    if (is_user_logged_in()) {

        //Sanitize the text comming from the user        
        $notaryID = sanitize_text_field($data['ID'] ?? 0);
        $indexNumber = sanitize_text_field($data['indexNumber']);
        $approvalKind = sanitize_text_field($data['approvalKind']);
        $clientName = sanitize_text_field($data['clientName']);
        $price = sanitize_text_field($data['price']);

        //Create date object for the ACF format for the notary
        $postDate = new DateTime(sanitize_text_field($data['approvalDate']));
        $approvalDate = $postDate -> format ('d/m/Y');
        
        //Create Notary post array
        $postArray = array (
            'ID' => $notaryID, 
            'post_author' => get_current_user_id(),
            'post_type' => 'notary',
            'post_status' => 'publish',
            'meta_input' => array(
                'index_number' => $indexNumber,
                'approval_date' => $approvalDate,
                'approval_kind' => $approvalKind,
                'client_name' => $clientName,
                'price' => $price,
                'documents' => [],
            ),
        );

        //creating the Notary post and return the post array after getting the post ID
        
        $postID = (wp_insert_post($postArray));
        $post = get_post($postID, 'ARRAY_A');
        $post['meta_data'] = get_post_meta($postID);
        return $post;
    }else {
        die("You don't have permission to add or edit posts. Please log in");
    }
}

function deleteNotaryCallback ($data) {
    $notaryID = sanitize_text_field($data['ID']);
    if (get_current_user_id() == get_post_field ('post_author', $notaryID)) {
        wp_delete_post($notaryID, true);
        return 'The notary has successfully deleted';
    }else {
        die("You do not have permission to delete this Item");
    }

}