$(document).ready(function () {
    //default active
    $("#member img").addClass("active");
    $("#acc-type").val("member");

    $(".acc-type").click(function () {
        $(".acc-type img").removeClass("active");
        $(this).find("img").addClass("active");

        if ($(this).attr("id") == "member") {
            $("#doc-info").html("");
            $("#submit").prop("disabled", false);
            $("#acc-type").val("member");
        } else if ($(this).attr("id") == "doctor") {
            $("#doc-info").html(docInfo);
            $("#submit").prop("disabled", false);
            $("#acc-type").val("doctor");
        } else if ($(this).attr("id") == "admin") {
            $("#doc-info").html("");
            $("#submit").prop("disabled", false);
            $("#acc-type").val("admin");
        }
    });

    fetch("js/data.json")
        .then(response => response.json())
        .then(data => {
            data.states.forEach(state => {
                $("#region").append(`<option value="${state.value}">${state.label}</option>`);
            });
        }
        );

    handleToggleIcon();
});

function handleToggleIcon() {
    const icon = $('#toggle-password i')
    const input = $('#password')

    icon.on('click', () => {
        icon.toggleClass('fa-eye fa-eye-slash');
        input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
    });
}

const docInfo = `
<h2 class="mb-12"><span>Doctor Information</span></h2>
<div class="grid grid-container mb-6">
    <div class="col-span-6">
        <label htmlFor="speciality">Speciality</label>
        <div class="mt-2">
            <select id="speciality" name="speciality" required>
                <option value="General Practitioner">General Practitioner</option>
                <option value="Cardiologist">Cardiologist</option>
                <option value="Dermatologist">Dermatologist</option>
                <option value="Pediatrician">Pediatrician</option>
                <option value="Neurologist">Neurologist</option>
                <option value="Orthopedic Surgeon">Orthopedic Surgeon</option>
                <option value="Oncologist">Oncologist</option>
            </select>
        </div>
    </div>

    <div class="col-span-6">
        <label htmlFor="medical-degree">Medical Degree</label>
        <div class="mt-2">
            <select id="medical-degree" name="medical-degree" required>
                <option value="MBBS">MBBS</option>
                <option value="MD">MD</option>
                <option value="Doctor of Osteopathic Medicine (DO)">Doctor of Osteopathic Medicine (DO)</option>
                <option value="Master of Surgery (MS)">Master of Surgery (MS)</option>
                <option value="Doctor of Medicine (DM)">Doctor of Medicine (DM)</option>
                <option value="Master of Chirurgiae (MCh)">Master of Chirurgiae (MCh)</option>
            </select>
        </div>
    </div>

    <div class="col-span-6">
        <label htmlFor="language">Language</label>
        <div class="mt-2">
            <select id="language" name="language" required>
                <option value="Malay">Malay</option>
                <option value="English">English</option>
                <option value="Mandarin">Mandarin</option>
            </select>
        </div>
    </div>
</div>
`;