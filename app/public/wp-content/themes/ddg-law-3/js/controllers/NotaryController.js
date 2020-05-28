
import $ from 'jquery';
import Notary from '../modules/Notary'

class NotaryController {
    constructor () {
        this.notary = new Notary();
        
        this.indexNumber = $("#indexNumber");
        this.clientName = $("#clientName");
        this.approvalKind = $("#approvalKind")
        this.approvalDate = $("#approvalDate")
        this.price = $("#price")
        this.btnSave = $(".btn-save")
        this.newNotaryForm = $("#newNotaryForm")
        this.table = $("#tbody");
        this.trashIcon = $(".trash-icon");
        this.editIcon = $(".edit-icon");
        this.btnOpenModal = $(".btn-open-modal")
        this.btnCloseModal = $(".btn-close-modal");
        this.notaryModal = $("#notaryModal");
        
        this.pickedNotary;
        this.events();
    }

    events () {
        this.newNotaryForm.on('submit', this.manageSaveBtn.bind(this));
        //$("#tbody").on('click', ".trash-icon", this.deleteNotaryItem.bind(this));
        this.trashIcon.on('click', this.deleteNotaryItem.bind(this));
        this.editIcon.on('click', this.openUpdateModal.bind(this));
        this.btnOpenModal.on('click', this.openModal.bind(this));
        this.btnCloseModal.on('click', this.closeModal.bind(this));
    }

    manageSaveBtn (e) {        
        e.preventDefault();           
        if ($("#notaryModal").data('id') == 0) {
            this.createNotaryItem()
        }else {
            this.saveUpdatedNotaryItem()
        }
    }

    createNotaryItem () {
        console.log('create');
        var data = {
            'ID' : $("#notaryModal").data('id'),
            'indexNumber' : this.indexNumber.val(),
            'clientName' : this.clientName.val(),
            'approvalKind' : this.approvalKind.val(),
            'approvalDate' : this.approvalDate.val(),
            'price' : this.price.val()
        }        
        this.notary.addNotary(data)
        .then((response) => {
            console.log('Congrats ' + JSON.stringify(response));

            var kind;
            $.each(ddglawData.approvalKindsList, function(key,value) {
                if (value.id == response.meta_data.approval_kind) {
                    $.each(this, (key, value) => {
                        if (key == 'title') {
                            kind = value;
                        }
                    })
                }
            })
            
            $(`
                <tr id="trow" data-id="${response.ID}">
                <th scope="row">${response.meta_data.index_number}</th>
                <td>${response.meta_data.client_name}</td>
                <td>${kind}</td>
                <td>${response.meta_data.approval_date}</td>
                <td> ${response.meta_data.price} ש״ח</td>
                <td>מסמכים</td>
                <td>
                    <span class="trash-icon"><i class="fas fa-trash-alt"></i></span>
                    <span class="edit-icon"><i class="far fa-edit"></i></span>
                </td>
                </tr>
            `).appendTo('#tbody').slideDown()
        })

        .catch((response) => {
            console.log('Error occurd ' + JSON.stringify(response));
        })
    }

    saveUpdatedNotaryItem () {
        console.log('update');
        var data = {
            'ID' : $("#notaryModal").data('id'),
            'indexNumber' : this.indexNumber.val(),
            'clientName' : this.clientName.val(),
            'approvalKind' : this.approvalKind.val(),
            'approvalDate' : this.approvalDate.val(),
            'price' : this.price.val()
        }

        this.notary.editNotary(data)
        .then ((response) => {
            console.log('Congrats ' + JSON.stringify(response));

            /*loop through the right approval kind from the approval kinds list 
            with the approval kind code came from the server*/
            var kind;
            $.each(ddglawData.approvalKindsList, function(key,value) {
                if (value.id == response.meta_data.approval_kind) {
                    $.each(this, (key, value) => {
                        if (key == 'title') {
                            kind = value;
                        }
                    })
                }
            })
            
            /*Start update the field in notay table with the updated notary  
            came from the server*/
            $(pickedNotary.children('#index-number-field')).text(response.meta_data.index_number);
            $(pickedNotary.children('#client-name-field')).text(response.meta_data.client_name);
            $(pickedNotary.children('#approval-kind-field')).data(kind);
            $(pickedNotary.children('#approval-date-field')).text(response.meta_data.approval_date);
            $(pickedNotary.children('#price-field')).text(response.meta_data.price);

            //Clear the add/update screen
            this.indexNumber.val(''),
            this.clientName.val(''),
            $("#approvalKind option[value='0']").attr('selected', 'selected');
            this.approvalKind.val(''),
            this.approvalDate.val(''),
            this.price.val('')

            //Close the modal and clean the picked notary row
            this.btnCloseModal.click();
            this.pickedNotary = null;
        })
        .catch ((response) => {
            console.log(JSON.stringify(response));
        })        
    }

    deleteNotaryItem (e) {
        var notary = $(e.target).parents('tr');        
        this.notary.deleteNotary(notary)
        .then ((response) => {
            notary.fadeOut('slow');
            console.log('Congrats ' + response);
        })
        .catch ((response) => {
            console.log('Error occurd ' + response);
        })
    }

    openUpdateModal (e) {        
        var notary = $(e.target).parents('tr');
        $("#notaryModal").data('id', notary.data('id'))
        
        this.btnOpenModal.click()
        
        $("#indexNumber").val($(notary.children('#index-number-field')).text());
        $("#clientName").val($(notary.children('#client-name-field')).text());
        
        $("#approvalKind option[value=" + $(notary.children('#approval-kind-field')).data('id') + "]").attr('selected', 'selected');

        const date = new Date((notary.children('#approval-date-field')).text().split("/").reverse().join("-"));
        const monthString = parseInt((date.getMonth() + 1),10);
        const month =  monthString < 10 ? "0" + monthString : monthString ;
        const day = parseInt((date.getDate()),10) < 10 ? "0" + date.getDate() : date.getDate() ;
        var dateString = date.getFullYear() + "-" + month + "-" + day; 
        
        $("#approvalDate").val(dateString);
        $("#price").val($(notary.children('#price-field')).text());
        this.pickedNotary = notary;
    }

    openModal () {                
        
    }

    closeModal () {        
        this.notaryModal.modal('hide'); 
    }
}
export default NotaryController;