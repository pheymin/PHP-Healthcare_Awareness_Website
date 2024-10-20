<div class="col-lg-3 border p-2 calender">
    <?php include "calender.php"; ?>

    <div id="event-detail" style="padding: 20px; display: none;">
        <hr>
        <h4>Event Detail</h4>
        <div>
            <h5 id="event-title"></h5>
            <p id="event-description"></p>
            <div class="flex space-x-4">
                <div>
                    <h5>Event Type</h5>
                    <p id="event-type"></p>
                </div>
                <div>
                    <h5>Start Date</h5>
                    <p id="start-date"></p>
                </div>
                <div>
                    <h5>End Date</h5>
                    <p id="end-date"></p>
                </div>
            </div>
            <div>
                <h5>Event Location</h5>
                <p id="location"></p>
            </div>
        </div>
    </div>
</div>

<script src="js/calender.js"></script>