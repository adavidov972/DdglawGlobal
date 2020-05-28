import $ from 'jquery';

class Notary {

    constructor () {
        this.errors = []
    }

    clean (data) {
        if (typeof(data.indexNumber) != "string") { data.indexNumber = "" }
        if (typeof(data.clientName) != "string") { data.clientName = "" }
        if (isNaN(data.price)) {data.price = 0}
        if (isNaN(data.approvalKind)) { data.approvalKind = "0" }
        if (typeof(data.approvalDate) != "string") { data.approvalDate = Date() }
        data.documentURLs = [];
        return data;
    }

    addNotary (data) {
        return new Promise ((resovle, reject) => {
            $.ajax ({
                beforeSend : (xhr) => {
                    xhr.setRequestHeader('X-WP-Nonce', ddglawData.nonce);
                },
                'method' : "POST",
                'url' : ddglawData.root_url + '/wp-json/notary/v1/manageNotary',
                'data' : this.clean(data),
                'success' : (response) => {
                    resovle(response)
                },
                'error' : (response) => {
                    reject(response)
                },
            });
        })
    }

    editNotary (data) {
        return new Promise ((resovle, reject) => {
            $.ajax ({
                beforeSend : (xhr) => {
                    xhr.setRequestHeader('X-WP-Nonce', ddglawData.nonce);
                },
                'method' : "POST",
                'url' : ddglawData.root_url + '/wp-json/notary/v1/manageNotary',
                'data' : this.clean(data),
                'success' : (response) => {
                    resovle(response);
                },
                'error' : (response) => {
                    console.log('Error occurd ' + JSON.stringify(response));
                    reject(response);
                },
            });
        })
    }

    deleteNotary (notary) {
        return new Promise ((resovle,reject) => {
            $.ajax ({
                beforeSend : (xhr) => {
                    xhr.setRequestHeader('X-WP-Nonce', ddglawData.nonce);
                },
                'method' : "DELETE",
                'url' : ddglawData.root_url + '/wp-json/notary/v1/deleteNotary/',
                'data' : {'ID' : notary.data('id')},
                'success' : (response) => {
                    resovle(response);
                },
                'error' : () => {
                    reject(response);
                },
            });
        });
        
    }
}

export default Notary