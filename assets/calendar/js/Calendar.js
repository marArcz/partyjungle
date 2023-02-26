class Calendar {
    constructor({ element, events = [], activeColor = "rgb(74 161 233)", disableDateWithEvents=false,eventLabel="" }) {
        this.element = $(element)
        this.events = events
        this.days = []
        this.strMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        this.days = [];
        this.eventList = [];
        this.currentDay = new Date();
        this.excludedDays = []
        this.currentYear = this.currentDay.getFullYear()
        this.selected = new Date()
        this.btnNext = null
        this.btnPrev = null
        this.activeColor = activeColor;
        this.onSelectDate = null
        this.disableDateWithEvents = disableDateWithEvents,
        this.eventLabel = eventLabel
    }

    createCalendar() {
        this.element.addClass("mz-calendar")
        console.log(this.element)
        let div = `
        <div class="calendar-header">
        <div class="left">
            <p id="month-year-label">November, 2022</p>
        </div>
        <div class="right">
            <div class="controls">
                <button type="button" id="calendar-btn-prev" class="control calendar-nav"><</button>
                <button type="button" id="calendar-today-btn" class="control">Today</button>
                <button type="button" id="calendar-btn-next" class="control calendar-nav">></button>
            </div>
        </div>
    </div>
    <div class="calendar-body">
        <div class="weekdays-container">
        </div>
        <div class="calendar-days-container">

        </div>
    </div>
        `

        this.element.append(div)
        this.btnNext = $("#calendar-btn-next")
        this.btnPrev = $("#calendar-btn-prev")
        this.btnNext.on('click', (e) => {
            let prevDate = this.selected
            let newDate = new Date(prevDate.getFullYear(), prevDate.getMonth() + 1, prevDate.getDate());

            this.selected = newDate
            this.loadDays()
            this.btnPrev.removeAttr("disabled")
        })

        if (this.currentDay.getMonth() - 1 < new Date().getMonth()) {
            this.btnPrev.attr("disabled", true)
        } else {
            this.btnPrev.removeAttr("disabled")
        }

        this.btnPrev.on('click', () => {
            let prevDate = this.selected
            let newDate = new Date(prevDate.getFullYear(), prevDate.getMonth() - 1, prevDate.getDate());

            this.selected = newDate
            this.loadDays()

            if (newDate.getMonth() === new Date().getMonth()) {
                this.btnPrev.attr("disabled", true)
            }
        })
        // this.btnPrev.on('click',this.btnPrevClicked)
        $("#calendar-today-btn").on('click', this.todayDate)
        this.addHeaderDays()
        this.loadDays()

    }

    todayDate = () => {
        this.selected = this.currentDay
        this.loadDays()
    }

    addHeaderDays() {
        let days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        for (let x = 0; x < days.length; x++) {
            let div = `
                <div class="weekday">${days[x]}</div>
            `
            this.element.find(".weekdays-container").append(div);
        }
    }
    isDayAvailable = (date, events) => {
        for (let x = 0; x < events.length; x++) {
            let eventDate = new Date(events[x].date)
            if (date.toDateString() === eventDate.toDateString()) {
                console.log("date: ", eventDate.toDateString());
                console.log("isFullybooked: ", events[x].isFullyBooked);
                return !events[x].isFullyBooked
            }
        }
        return true;
    }
    loadDays() {
        let prevDate = this.selected

        if (this.selected.getMonth()  === new Date().getMonth()) {
            this.btnPrev.attr("disabled", true)
        }else{
            this.btnPrev.removeAttr("disabled", true)
        }

        console.log('loading days')
        if (this.onSelectDate !== null) {
            console.log('onSelectDate')

            this.onSelectDate(this.selected)
        }
        $("#month-year-label").html(this.strMonths[this.selected.getMonth()] + ", " + this.selected.getFullYear());

        const firstDayOfMonth = new Date(this.selected.getFullYear(), this.selected.getMonth(), 1);
        const weekdayOfFirstDay = firstDayOfMonth.getDay();



        var currentDays = [];
        var today = new Date();

        for (let day = 0; day < 42; day++) {
            if (day === 0 && weekdayOfFirstDay === 0) {
                firstDayOfMonth.setDate(firstDayOfMonth.getDate() - 7);
            } else if (day === 0) {
                firstDayOfMonth.setDate(firstDayOfMonth.getDate() + (day - weekdayOfFirstDay));
            } else {
                firstDayOfMonth.setDate(firstDayOfMonth.getDate() + 1);
            }

            let calendarDay = {
                currentMonth: (firstDayOfMonth.getMonth() === this.selected.getMonth()),
                date: (new Date(firstDayOfMonth.getFullYear(), firstDayOfMonth.getMonth(), firstDayOfMonth.getDate())),
                month: firstDayOfMonth.getMonth(),
                number: firstDayOfMonth.getDate(),
                isSelected: this.selected !== null ? (firstDayOfMonth.toDateString() === this.selected.toDateString()) : false,
                year: firstDayOfMonth.getFullYear(),
                isAvailable: this.isDayAvailable(firstDayOfMonth, this.eventList),
                passed: false,
                isSunday: firstDayOfMonth.getDay() === 0,
                day: firstDayOfMonth.getDay(),
                events: []
            }
            let passed = false;
            if (firstDayOfMonth.getDate() < today.getDate() && firstDayOfMonth.getMonth() === today.getMonth()) {
                calendarDay.passed = true;
            } else if (firstDayOfMonth.getMonth() < today.getMonth() && firstDayOfMonth.getFullYear() == today.getFullYear()) {
                calendarDay.passed = true;
            }
            currentDays.push(calendarDay);
        }
        console.log('event-list: ', this.eventList)
        for (let event of this.eventList) {
            // let date = event.date.replace( /[-]/g, '/' );
            let date = Date.parse(event.date);
            let eventDate = new Date(date);
            for (let day of currentDays) {
                let calendarDate = new Date(day.year, day.month, day.number);
                if (eventDate.toDateString() === calendarDate.toDateString()) {
                    let newEvent = {
                        title: event.title,
                        day: day.number,
                        month: day.month,
                        year: day.year,
                        time: `${event.time}`,
                        passed: day.month <= today.getMonth() ? (day.number < today.getDate() ? true : false) : false
                    }
                    day.events = [...day.events, newEvent]
                }
            }

        }
        this.displayDays(currentDays)

    }

    displayDays(currentDays) {
        let calendar = this.element.find('.calendar-days-container');
        calendar.html("");
        for (let day of currentDays) {
            if (day.passed) {
                let calendarDay = `
                        <div class="calendar-day">
                            <span>${day.number}</span>
                        </div>
                    `;
                calendar.append(calendarDay)
            } else {
                let calendarDay = `
                        <div data-date="${day.year}-${day.month + 1}-${day.number}" class=" ${day.events.length > 0 ? "reserved":"enabled"} calendar-day ${day.currentMonth ? "current-day" : ""} ${day.isSelected ? "selected" : ""}">
                                <span class="number">${day.number}</span>
                                <span class="number mt-5">${day.events.length > 0 ? "<i class='bx bxs-flag'></i> Booked":""}</span>
                                ${day.events.length > 0 ? `<span class="dot"></span>` : ""}
                        </div>
                    `;
                calendar.append(calendarDay)
            }
        }
        this.element.find('.calendar-day.selected').css("background", this.activeColor);
        this.element.find('.weekday').css("color", this.activeColor);
        this.setHandlers()
    }

    setHandlers() {
        var onSelect = (date) => {
            this.selected = date
            this.loadDays()
            this.onSelectDate(date)
        }
        $(".calendar-day.enabled").on("click", function (e) {
            let date = new Date($(e.currentTarget).data('date'));
            onSelect(date)
        })

    }

    setOnSelectDate(onSelectDate) {
        this.onSelectDate = onSelectDate
    }


}