async function deactivate_hosp(hosp_id) {
    let confirm_ = await Swal.fire({
        icon: "info",
        title: "Confirm Hospital Deactivation",
        text: "After this action hospital will be deactivated and doctor won't be able to login to his account!",
        showCancelButton: true,
        showConfirmButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes, I Confirm!'
    });
    if (confirm_.value) {
        window.location.href = "./backend/hosp_state.php?state=deactivate&id=" + hosp_id;
    }


}

async function reject_hosp(hosp_id) {
    let confirm_ = await Swal.fire({
        icon: "info",
        title: "Reject Hospital Request",
        text: "After this action hospital request will be rejected and doctor won't be able to login to his account!",
        showCancelButton: true,
        showConfirmButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes, I Confirm!'
    });
    if (confirm_.value) {
        window.location.href = "./backend/hosp_state.php?state=reject&id=" + hosp_id;
    }

}

async function activate_hosp(hosp_id) {
    let confirm_ = await Swal.fire({
        icon: "info",
        title: "Confirm Hospital Activation",
        text: "After this action hospital will be Activated and doctor will be able to login and start reporting!",
        showCancelButton: true,
        showConfirmButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes, I Confirm!'
    });
    if (confirm_.value) {
        window.location.href = "./backend/hosp_state.php?state=activate&id=" + hosp_id;
    }

}