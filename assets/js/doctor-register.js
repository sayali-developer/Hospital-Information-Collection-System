$(document).ready(function () {
    registerFormReset();
});

function hospChanged(val) {
    if (val == "other") {
        document.getElementById("spec_other_type").style.display = "";
        document.getElementById("other_type").focus();
    } else {
        document.getElementById("spec_other_type").style.display = "none";
    }
}

function registerFormSubmit() {
    let hosp_name = document.getElementById("hosp_name").value.trim();
    let hosp_type = document.getElementById("type_of_hosp").value;
    let doc_name = document.getElementById("doctor_name").value.trim();
    let mobile = parseInt(document.getElementById("mobile").value);
    let subdist = document.getElementById("subdist").value;
    let address = document.getElementById("address").value.trim();
    let hosp_cat = document.getElementById("cat_of_hosp").value;
    let other_type = ``;
    if (hosp_name.length < 5 || hosp_name.length > 256) {
        Swal.fire({
            title: `Please Enter Valid Hospital Name`,
            icon: `warning`
        });
        return false;
    }
    if (!(hosp_type == "ayurvedic" || hosp_type == "allopathy" || hosp_type == "homoeopathy" || hosp_type == "unani" || hosp_type == "other")) {
        Swal.fire({
            title: `Please Select Valid Hospital Type`,
            icon: `warning`
        });
        return false;
    }
    if (hosp_type == "other") {
        other_type = document.getElementById("other_type").value.trim();
        if (other_type.length < 3 || other_type > 64) {
            Swal.fire({
                title: `Please Specify Hospital Type`,
                icon: `warning`,
                text: `You Selected Hospital Type As Other, Please Specify Your Hospital Type!`
            });
            return false;
        }
    }
    if (!(hosp_cat == "private" || hosp_cat == "government")) {
        Swal.fire({
            title: `Please select valid hospital category!`,
            icon: `warning`,
            text: 'Please select hospital category either government or private.'
        });
        return false;
    }
    if (doc_name.length < 5 || doc_name.length > 256) {
        Swal.fire({
            title: `Please Enter Doctor's Name Properly`,
            icon: `warning`
        });
        return false;
    }
    if (mobile < 100000000 || mobile > 9999999999) {
        Swal.fire({
            title: `Please Enter Valid Doctor's Mobile Number`,
            icon: `warning`
        });
        return false;
    }
	
    if (!(
	subdist == "Pune City" || subdist == "Pimpri-Chinchwad City" || subdist == "Haveli" || subdist == "Khed" || subdist == "Ambegaon" ||
            subdist == "Junnar" || subdist == "Shirur" || subdist == "Daund" || subdist == "Indapur" || subdist == "Baramati" || subdist == "Purandar" || subdist == "Bhor" || subdist == "Velhe" || subdist == "Mulshi" || subdist == "Maval"
	)) {
        Swal.fire({
            title: `Please Select Valid Taluka`,
            icon: `warning`
        });
        return false;
    }
    if (address.length < 5 || address.length > 512) {
        Swal.fire({
            title: `Please Enter Valid Hospital Address`,
            icon: `warning`
        });
        return false;
    }

    let http = new XMLHttpRequest();
    http.onreadystatechange = function () {
        if (this.readyState == 1) {
            Swal.fire({
                title: `Please Wait, We Are Checking Your Registration Form!`,
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });

        } else if (this.readyState == 2) {
            Swal.fire({
                title: `Please Wait, Sending Your Data To Server!`,
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
        } else if (this.readyState == 3) {
            Swal.fire({
                title: `Please Wait, Your Data Is Being Verified By Server!`,
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
        } else if (this.readyState == 4) {
            if (this.status == 200) {
                let data;
                try {
                    data = JSON.parse(this.responseText);
                } catch (e) {
                    Swal.fire({
                        title: `Server Error`,
                        text: `There was error while processing your data. Please try after some time.`,
                        icon: `error`
                    });
                }
                if (data.error == "false") {
                    Swal.fire({
                        title: `Registration Successful!`,
                        text: `Registration of your hospital is completed successfully. You will receive the login and password on given mobile number in next 24 hours if approved by competent authority. Use that login and password for daily reporting. Please refer instructions for daily reporting. Thank you.`,
                        icon: `success`
                    });
                    registerFormReset();
                }
            } else if (this.status == 400) {
                Swal.fire({
                    title: `Please Check Your Form!`,
                    text: `There are some errors in your form, Please check your form.`,
                    icon: `warning`
                });
            } else if (this.status == 500) {
                Swal.fire({
                    title: `Server Error`,
                    text: `There was error while processing your data. Please try after some time.`,
                    icon: `error`
                });
            } else if (this.status == 403) {
                Swal.fire({
                    title: `Mobile Number Already Registered!`,
                    text: `Mobile Number Already Registered To Another Hospital, If You Have Registered On Our Website Previously Then Login Using Your Credentials.`,
                    icon: `error`
                });
            } else if (this.status == 0) {
                Swal.fire({
                    title: `Connection Error`,
                    text: `There was an error while connecting to the server, please check your internet connection or try again.`
                });
            }
        }
    };
    let data = new FormData();
    data.append("hosp_name", hosp_name);
    data.append("hosp_type", hosp_type);
    data.append("hosp_cat", hosp_cat);
    data.append("other_type", other_type);
    data.append("subdist", subdist);
    data.append("address", address);
    data.append("mobile", mobile);
    data.append("doc_name", doc_name);

    data.append("no_of_beds", document.getElementById("no_of_beds").value);
    data.append("no_of_wards", document.getElementById("no_of_wards").value);
    data.append("no_of_docs", document.getElementById("no_of_docs").value);
    data.append("no_of_nurses", document.getElementById("no_of_nurses").value);
    data.append("no_of_other_staff", document.getElementById("no_of_other_staff").value);
    data.append("no_of_amb", document.getElementById("no_of_amb").value);
    data.append("no_of_ppe", document.getElementById("no_of_ppe").value);
    data.append("no_of_vent", document.getElementById("no_of_vent").value);
    data.append("no_of_o2_cel", document.getElementById("no_of_o2_cel").value);
    data.append("no_of_o2_conc", document.getElementById("no_of_o2_conc").value);
    data.append("no_of_monitors", document.getElementById("no_of_monitors").value);
    data.append("no_of_neb", document.getElementById("no_of_neb").value);


    http.open("post", "./saveRegisterData.php", true);
    http.setRequestHeader("cache-control", "no-cache");
    http.send(data);
}

function registerFormReset() {
    document.getElementById("spec_other_type").style.display = "none";
    document.getElementById("doctor_reg_form").reset();

}
