class DateHelper{

	constructor(){
		this.monthIndex = 0;
	}

	getMonthNumber(){
		return moment().add(this.monthIndex , 'months').format("MM");
	}

	getMonthName(){
		return moment().add(this.monthIndex , 'months').format("MMMM");
	}

	getYear(){
		return moment().add(this.monthIndex , 'months').format("YYYY");
	}

	getCurrentDate(){
		return moment().format("YYYY-MM-DD");
	}

	getWeekdays(){
		return moment.weekdays();
	}

	getFirstDayOfMonth(){
		return this.getYear() + "-" + this.getMonthNumber() + "-" + "01";
	}

	getLastDayOfMonth(){	
		return moment(this.getFirstDayOfMonth()).endOf("month").format("YYYY-MM-DD");
	}

	getFirstDayMonthIndex(){
		let date = this.getYear() + "-" + this.getMonthNumber() + "-" + "01";
		let amountSkip = parseInt(moment(date).format("e"));

		
		// BECAUSE THE DUTCHIES START WITH MONDAY AND NOT SUNDAY, DELETE THIS IF LOCALE CHANGES
		if(amountSkip == 6){
			amountSkip = 0;
			return amountSkip;
		}	
		return amountSkip + 1;
	}

	getDaysInMonth(){
		return moment().add(this.monthIndex , 'months').daysInMonth();
	}

	checkIfDatePassed(date){
		let moment_date = moment(date);
		if(moment_date.diff(moment(), 'days') < 0){
			return false;
		}else{
			return true;
		}
	}

	checkAvailability(time_start, time_end, bookedTimes){

		// turn times into int
		let start_hour = parseInt(this.replaceTimeToInt(time_start));
		let end_hour = parseInt(this.replaceTimeToInt(time_end));

		for(var times in bookedTimes){
			// substr time to have format HH:mm
			let booked_time_start = bookedTimes[times].start_time.substr(0, 5);
			let booked_time_end = bookedTimes[times].end_time.substr(0, 5);

			// turn times into int
			let booked_time_start_int = parseInt(this.replaceTimeToInt(booked_time_start));
			let booked_time_end_int = parseInt(this.replaceTimeToInt(booked_time_end));

			// check if selected start_hour is available
			if(!this.inRangeStartEqual(start_hour, booked_time_start_int, booked_time_end_int)){
				return false;
			}

			// check if selected end_hour is available
			if(!this.inRangeEndEqual(end_hour, booked_time_start_int, booked_time_end_int)){
				return false;
			}

			// check if the booked times overlap with already booked times
			if(!this.inRange(booked_time_start_int, start_hour, end_hour)){
				return false;
			}

			// check if the booked times overlap with already booked times
			if(!this.inRange(booked_time_end_int, start_hour, end_hour)){
				return false;
			}
		}
		// if times are not booked yet, return true!
		return true;
	}

	replaceTimeToInt(time){
		return time.replace(":", "");
	}

	inRangeStartEqual(compareInt, to1, to2){
		if(compareInt >= to1 && compareInt < to2){
			return false;
		}
		return true;
	}

	inRangeEndEqual(compareInt, to1, to2){
		if(compareInt > to1 && compareInt <= to2){
			return false;
		}
		return true;
	}

	inRange(compareInt, to1, to2){
		if(compareInt > to1 && compareInt < to2){
			return false;
		}
		return true;
	}

	getDateByDayNumber(day){
		return this.getYear() + "-" + this.getMonthNumber() + "-" + day;
	}

	getDayName(date){
		return moment(date, "YYYY-MM-DD").format("dddd");
	}

	getDayNameByDayNumber(dayNumber) {
		return this.getDayName(this.getDateByDayNumber(dayNumber));
	}

	getMonthNameByDate(date){
		return moment(date, "YYYY-MM-DD").format("MMMM");
	}

	getYearByDate(date){
		return moment(date, "YYYY-MM-DD").format("YYYY");
	}

	getDayNumberByDate(date){
		return moment(date, "YYYY-MM-DD").format("DD");
	}

	addMinutesToTime(time, minutesToAdd) {
		let hours = time.split(':')[0];
		let minutes = time.split(':')[1];

		let start_hour = this.getCurrentDate() + " " + time;
		time = moment(start_hour, "YYYY-MM-DD HH:mm");

		time.add(minutesToAdd, 'm');

		return time.format("HH:mm");
		
	}

	differenceBetweenHours(start_time, end_time){

		let start_hour = this.getCurrentDate() + " " + start_time;
		let end_hour = this.getCurrentDate() + " " + end_time;

		let start_day = moment(start_hour, "YYYY-MM-DD HH:mm");
		let end_day = moment(end_hour, "YYYY-MM-DD HH:mm");

		let differenceInMinutes = end_day.diff(start_day, 'minutes');

		return (differenceInMinutes / 60);
	}

	nextMonth(){

		if(this.monthIndex < 6) {
			this.monthIndex += 1;
			Event.fire('dateHelper:nextMonth');
		} else {
			Notifier.warning('U kunt niet zover vooruit boeken');
		}
	}

	previousMonth(){
		if(this.monthIndex > 0){
			this.monthIndex -= 1;
			Event.fire('dateHelper:previousMonth');
		}else{
			Notifier.warning("U kunt geen datum uit het verleden selecteren.");
		}
	}



}

export default DateHelper;