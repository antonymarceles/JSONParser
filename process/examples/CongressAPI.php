<?php
require(__DIR__ . '/../bootstrap.php');

$query = urlencode('#PHP');
$response = \Httpful\Request::get("http://api.opencongress.org/people?person_id=300082&format=json")->send();

if (!$response->hasErrors()) {
	echo $response->body->people[0]->person->name;
    foreach ($response->body->people as $congressMan) {
       // echo "$response->body->people->person->religion";
       echo $congressMan->person->name;
    }
} else {
    echo "Uh oh.  Congress API gave us the old {$response->code} status.\n";
}


?>