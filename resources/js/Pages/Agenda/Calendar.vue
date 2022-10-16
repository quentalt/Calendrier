<template>

    <div>
        <fullCalendar ref="fullCalendar" :options="calendarOptions" />

    </div>
</template>

<show-appointment-modal
    :show="show_event_details_modal"
    :event="current_event"
    @close="show_event_details_modal = false"
    @dateClick = "handleDateClick"
    @event-deleted="rerenderCalendar"
    @event-updated="rerenderCalendar"
    @eventDrop="handleEventDrop"
    @eventClick="handleEventClick"
/>

<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import daygrid from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import listPlugin from '@fullcalendar/list'
import timeGrid from '@fullcalendar/timegrid';
import Noty from "bootstrap-vue-3";


export default {
    name: 'Calendar',

    components: {
        FullCalendar,

    },

    data: () => ({
        new_event_details: {
            start:null,
                end:null,
        },
        current_event:null,
        show_event_details_modal:false,
          calendarPlugins: [ daygrid, interactionPlugin, timeGrid , listPlugin],
                initialView: 'dayGridMonth',
                editable:true,
                selectable:true,
                displayEventTime:true,
                headerToolbar: {
                    left: 'prev,next, today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                allDaySlot: false,
                slotMinTime: '08:00:00',
                slotMaxTime: '20:00:00',
                height: 'auto',
        calendarWeekends: true,
        calendarEvents:
            {
                url: '/appointments/filter'
            },
        calendarOptions: {
            eventLimit: true,
            views: {
                timeGrid: {
                    eventLimit: 4
                },
                monthGrid: {
                    eventLimit: 4
                },
                dayGrid: {
                    eventLimit: 4,
                }
            },
        },
    }),

      methods: {
        handleDateClick(e) {
            this.new_event_modal_open = true
            this.new_event_modal_start = e.dateStr
            let endTime = (new Date(e.dateStr)).toISOString()
            this.new_event_details.start = e.dateStr
            this.new_event_details.end = endTime
        },
          handleEventDrop() {
              let updatedEventData = {
                  start: e.event.start,
                  end: e.event.end
              }
              this.$api.appointments.update(e.event.id, updatedEventData)
                  .then( ({data}) => {
                      new Noty({
                          text: `Event has been updated.`,
                          timeout: 700,
                          type: 'success'
                      }).show()
                  })
                  .catch(error => {
                      e.revert()
                      new Noty({
                          text:`Oops, something bad happened while updating your event.`,
                          timeout:1000,
                          type:'error'
                      }).show()
                  })
          },
          handleEventClick(e) {
            this.current_event = e.event
              this.show_event_details_modal = true
          },

          rerenderCalendar() {
             this.$refs.fullCalendar.getApi().refetchEvents()
          }
      }
}
</script>

<style>
</style>
