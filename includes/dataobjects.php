<?php

class vehicle {
	public $name;
	public $type;
	public $color;
}

class location {
	public $label;
	public $address;
}

class preferences {
	
}

class user {
	public $userId;
	public $username;
	public $name;
	public $vehicles;
	public $locations;
	public $preferences;
	public $driverRating;
	public $passengerRating;
	
	public function getNotifications() {
		
	}
	
	public function getUpcomingRides() {
		
	}
	
	public function getPendingRideRatings() {
		
	}
}

class reservation {
	public $rideId;
	public $passengerUid;
	public $comment;
	public $status; //(Requested / Confirmed / Denied)
	public $requestedOnDate;
	public $responseDate;
}


class ride {
	public $rideId;
	public $startLocation;
	public $destinationLocation;
	public $price;
	public $maxSeats;
	public $reservedSeats;
	public $tripStartTime;
	public $nextRideDate;
	public $tripFrequency;
	public $recurringTripDays; //(days of the week) E.g. SMTWTFS, --T--F-, -MT-T--
	public $recurringUntil;
	public $tripType; //(Oneway / Roundtrip)
	public $returnTripStartTime;
	public $reservations;
	public $status; //(Posted, Completed, Expired, Deleted)
	
	public function storeRecurringRideDates () {
		
	}
	
	public function storeRidetoDB() {

	}
}

?>