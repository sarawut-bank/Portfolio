function pageload() {
    showDataCompany(0)
}

function showDataCompany(company_id) {
    formData = {
        "option": company_id,
    }

    $.ajax({
        type: "POST",
        url: 'company',
        data: formData,

        headers: {
            "X-CSRFToken": $('input[name="csrfmiddlewaretoken"]').val()
        },
        success: function (data) {
            console.log(data)
            if (data.status == "success") {
                var content_main = $('.content_main')
                content_main.empty()
                $('.show_items').empty()
                $('.show_items').html(data.companyData.length)
                for (var listitem = 0; listitem < data.companyData.length; listitem++) {
                    let tempTr = `
                    <div class="machine_list">
                        <div class="show_list">
                            <b>Company ID : ${data.companyData[listitem]['id']}</b><br>
                            <a>Company Name : ${data.companyData[listitem]['name_company']}</a><br>
                        </div>
                        <div class="button_func">
                            <div class="view">
                                <button class="view_button" type="button" onclick="viewCompany(${data.companyData[listitem]['id']})">ViewDetails</button>
                            </div>
                            <div class="del">
                                <button class="del_button" onclick="deleteCompany(${data.companyData[listitem]['id']})">Delete</button>
                            </div>
                        </div>
                    </div>

                    `
                    content_main.append(tempTr)
                }
            }
            if (data.companyData.length == 0) {
                content_main.append("not has company")
            }
        }
    })

}

function viewCompany(company_id) {
    formData = {
        "option": 0,
        'company_id': company_id,
    }

    $.ajax({
        type: "POST",
        url: 'company',
        data: formData,

        headers: {
            "X-CSRFToken": $('input[name="csrfmiddlewaretoken"]').val()
        },
        success: function (data) {
            console.log(data)
            if (data.status == "success") {
                var myModal = $('#myModal')
                for (var listitem = 0; listitem < data.companyData.length; listitem++) {
                    myModal.empty()
                    let modalContent = `
                        <div class="modal-content">
                            <div class="header">
                                <b>Company Details</b>
                                <span class="close" onclick="closeModal()">&times;</span>
                            </div>
                            <br>
                            <table>
                                <tr>
                                    <td id="mainTd"><a>Company ID : </a></td>
                                    <td>${data.companyData[listitem]['id']}</td>
                                </tr>
                                <tr>
                                    <td><a>Company Name : </a></td>
                                    <td>${data.companyData[listitem]['name_company']}</td>
                                </tr>
                                <tr>
                                    <td><a>Company Abbreviation : </a></td>
                                    <td>${data.companyData[listitem]['abb_company']}</td>
                                </tr>
                                <tr>
                                    <td><a>Company Address : </a></td>
                                    <td>${data.companyData[listitem]['address_company']}</td>
                                </tr>
                            </table>
                            <div class="modal-footer">
                                <div class="box_left">
                                    <button type="button" class="edit_button" onclick="editCompany(${data.companyData[listitem]['id']})">Edit</button>
                                </div>
        
                            </div>
                        </div>
                        `
                    var modal = document.getElementById("myModal");
                    modal.style.display = "block";
                    myModal.append(modalContent)
                }
            }
        }
    })
}

function closeModal() {
    var modal = document.getElementById("myModal");
    var modalAddnew = document.getElementById("modalAddnew");
    modal.style.display = "none";
    modalAddnew.style.display = "none";
}

function editCompany(company_id) {
    console.log(company_id)
    formData = {
        "option": 0,
        "company_id": company_id,
    }

    $.ajax({
        type: "POST",
        url: 'company',
        data: formData,

        headers: {
            "X-CSRFToken": $('input[name="csrfmiddlewaretoken"]').val()
        },

        success: function (data) {
            console.log(data)
            if (data.status == "success") {
                var myModal = $('#myModal')
                for (var listitem = 0; listitem < data.companyData.length; listitem++) {
                    myModal.empty()
                    let modalContent = `
                        <div class="modal-content">
                            <div class="header">
                                <b>Company Details</b>
                                <span class="close" onclick="closeModal()">&times;</span>
                            </div>
                            <br>
                            <table>
                                <tr>
                                    <td id="mainTd"><a>Company ID : </a></td>
                                    <td><input class="form-control" type="text" value="${data.companyData[listitem]['id']}" disabled></td>
                                </tr>
                                <tr>
                                    <td><a>Company Name : </a></td>
                                    <td><input id="companyName" class="form-control" type="text" value="${data.companyData[listitem]['name_company']}"</td>
                                </tr>
                                <tr>
                                    <td><a>Company Abbreviation : </a></td>
                                    <td><input id="companyAbb" class="form-control" type="text" value="${data.companyData[listitem]['abb_company']}"</td>
                                </tr>
                                <tr>
                                    <td><a>Company Address : </a></td>
                                    <td><input id="companyAddress" class="form-control" type="text" value="${data.companyData[listitem]['address_company']}"</td>
                                </tr>
                            </table>
                            <div class="modal-footer">
                                <div class="box_left">
                                    <button type="button" class="save_button" onclick="SaveEdit(${data.companyData[listitem]['id']})">Save</button>
                                </div>
        
                            </div>
                        </div>
                        `
                    var modal = document.getElementById("myModal");
                    modal.style.display = "block";
                    myModal.append(modalContent)
                }
            }
        }
    })
}

function SaveEdit(company_id) {
    var nameCompany = $('#companyName').val();
    var abbCompany = $('#companyAbb').val();
    var AddressCompany = $('#companyAddress').val();
    
    console.log("data :", nameCompany)

    Swal.fire({
        title: 'Are you sure to save?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        customClass: {
            popup: 'popup-waring-delete',
            confirmButton: 'custom-confirm-button-class',
            CancelButton: 'custom-cancel-button-class',
        }
    }).then((result) => {
        if (result.isConfirmed) {

            formData = {
                'option': 0,
                'company_id': company_id,
                'name_company': nameCompany,
                'abb_company': abbCompany,
                'address_company': AddressCompany,
            }

            $.ajax({
                type: "POST",
                url: 'editcompany',
                data: formData,

                headers: {
                    "X-CSRFToken": $('input[name="csrfmiddlewaretoken"]').val()
                },

                success: function (data) {
                    if (data.status == "success") {
                        console.log(data)
                        location.reload();
                    }
                }
            })
        }
    })
}

function deleteCompany(company_id) {
    Swal.fire({
        title: 'Are you sure to delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        customClass: {
            popup: 'popup-waring-delete',
            confirmButton: 'custom-confirm-button-class',
            CancelButton: 'custom-cancel-button-class',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            formData = {
                "option": 0,
                "company_id": company_id,
            }

            $.ajax({
                type: "POST",
                url: 'deletecompany',
                data: formData,

                headers: {
                    "X-CSRFToken": $('input[name="csrfmiddlewaretoken"]').val()
                },

                success: function (data) {
                    if (data.status == "success") {
                        console.log(data);
                        location.reload();
                    }
                }

            })
        }
    })
}

function addnewCompanyButton(){
    var modal = document.getElementById("modalAddnew");
    modal.style.display = "block";
}

function addNewDataCompany(){
    formData = {
        'name_company': $('#newCompanyName').val(),
        'abb_company': $('#newCompanyAbb').val(),
        'address_company': $('#newCompanyAddress').val(),
    }

    console.log(formData)

    $.ajax({
        type: "POST",
        url: 'addnewCompany',
        data: formData,
        headers: {
            "X-CSRFToken": $('input[name="csrfmiddlewaretoken"]').val()
        },

        success: function (data) {
            console.log(data)
        }
    })
}