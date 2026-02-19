<?php
/*
 * cancel-jobcard-list.php  (API)
 *
 * FIX: Replaced SELECT * with explicit column aliases.
 *
 * ROOT CAUSE OF PREVIOUS BUG:
 *   SELECT * across 4 JOINed tables caused PHP fetch_assoc() to silently
 *   overwrite shared column names — $row['id'] ended up as job_card_type.id
 *   (NOT job_card.id), so the invoice modal fetched the wrong job card.
 *
 * SORT: ORDER BY jobcard_cancel.created_date DESC
 *   → Latest canceled job card always appears first.
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

$stationID = $conn->real_escape_string($_SESSION['station_id']);

$sql = "
    SELECT
        job_card.id                     AS id,
        job_card.job_card_code          AS job_card_code,
        job_card.created_date           AS JOB_CARD_PLACED_DATE,

        job_card_type.type              AS JOB_CARD_TYPE,

        vehicle_owner.first_name        AS first_name,
        vehicle_owner.last_name         AS last_name,
        vehicle_owner.phone             AS phone,

        vehicle.vehicle_number          AS vehicle_number,

        jobcard_cancel.created_date     AS CANCELED_DATE

    FROM  job_card
    JOIN  vehicle        ON  vehicle.id              = job_card.vehicle_id
    JOIN  vehicle_owner  ON  vehicle_owner.id        = job_card.vehicle_owner_id
    JOIN  jobcard_cancel ON  jobcard_cancel.job_card_id = job_card.id
    JOIN  job_card_type  ON  job_card_type.id        = job_card.job_card_type_id

    WHERE  job_card.status_id          = 2
      AND  job_card.service_station_id = '$stationID'

    ORDER BY STR_TO_DATE(jobcard_cancel.created_date, '%Y-%m-%d %H:%i:%s') DESC
";

$result   = $conn->query($sql);
$jobcards = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobcards[] = $row;
    }
}

// Sort by CANCELED_DATE descending in PHP as a guaranteed fallback
usort($jobcards, function($a, $b) {
    return strtotime($b['CANCELED_DATE']) - strtotime($a['CANCELED_DATE']);
});
?>