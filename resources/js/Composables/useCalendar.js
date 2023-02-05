import { ref, computed } from "vue"

export function useCalendar() {
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December'];
    const days = [
        {
            id: 0,
            name: 'Mon',
        },
        {
            id: 1,
            name: 'Tue',
        },
        {
            id: 2,
            name: 'Wed',
        },
        {
            id: 3,
            name: 'Thu',
        },
        {
            id: 4,
            name: 'Fri',
        },
        {
            id: 5,
            name: 'Sat',
        },
        {
            id: 6,
            name: 'Sun',
        },
    ];
    let today = ref(new Date());
    let currentYear = computed(() => {
        return today.value.getFullYear();
    });
    let currentMonth = computed(() => {
        return {
            id: today.value.getMonth(),
            name: months[today.value.getMonth()]
        }
    })

    const getAllDaysInMonth = () => {
        let date = new Date(currentYear.value, currentMonth.value.id, 1);
        let dates = [];
        let i = 0;

        // Fill in previous month's dates if the first day of the month is not a Monday
        if (date.getDay() !== 1) {
            let prevMonth = new Date(date.getFullYear(), date.getMonth(), 0);
            let prevMonthDays = prevMonth.getDate();

            for (let j = prevMonthDays - (date.getDay() - 2); j <= prevMonthDays; j++) {
                dates.push(new Date(prevMonth.getFullYear(), prevMonth.getMonth(), j));
            }
        }

        while (date.getMonth() === currentMonth.value.id) {
            dates.push(new Date(date));
            date.setDate(date.getDate() + 1);
            i++;
        }

        // Fill in next month's dates if the last day of the month is not a Sunday
        if (dates[dates.length - 1].getDay() !== 0) {
            let nextMonth = new Date(date.getFullYear(), date.getMonth() + 1, 1);
            for (let j = 1; j <= 7 - dates[dates.length - 1].getDay(); j++) {
                dates.push(new Date(nextMonth.getFullYear(), nextMonth.getMonth(), j));
            }
        }

        return dates;
    }

    return {
        months,
        today,
        currentMonth,
        getAllDaysInMonth,
        currentYear,
        days
    }
}