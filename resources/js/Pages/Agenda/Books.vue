<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Calendrier
            </h2>
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
            role="alert"
            v-if="showAlert"
            >
            <div id="calendar"></div>
            <div class="flex">
                    <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg></div>
                <div>
                          <p class="font-bold">Réservation réussie !!</p>
                </div>
            </div>
        </div>
            </template>
        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <Calendar @dateClick="dateClick"/>
                 </div>
            </div>
        </div>
             <CalendarModal
             v-show="showModal"
             :form="newEvent"
              @closeModal="closeModal"
              @saveAppt="saveAppt"
              />


    </AppLayout>
</template>
<script>
import Calendar from "./Calendar.vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import CalendarModal from './Modals/CalendarModal.vue';
import formatTime from '../../Mixins/transformTime.js';
import { Inertia } from "@inertiajs/inertia";

export default {
    name: 'Books',
    props: {
    },
    components: {
    Calendar,
    AppLayout,
    CalendarModal
},
computed: {
showAlert() {
        if(this.$page.success !== null) {
            setTimeout(() => {
                this.$page.success = null
            }, 3000)
            return true
        }
        return false
    }
},
data() {
    return {
        showModal: false,
        newEvent: {
            title: '',
            date_at: '',
            hour: '',
            session: 1800,
            booked_by:'',
            user_id: '',
        },
    }
},
methods:
{
    dateClick(arg)
    {
        this.$data.showModal = true;
        this.setModalOpen(arg)
       //console.log('date reçus: ',arg)
    },
    showModal() {
        this.$data.showModal = true;
      },
   closeModal() {
        this.$data.showModal = false;
      },
    setModalOpen(obj) {
       let dateetime = obj.dateStr.split('T');
        this.newEvent.date_at = dateetime[0];
        this.newEvent.hour = dateetime[1].substring(0 ,8)
        //this.newEvent.user_id = this.$page.user.id;

    },
    resetModal() {
         return  {
             title: '',
             date_at: '',
             hour: '',
             session: 1800,
         }
    },
    saveAppt(param) {
    if(param.title === '') {
        alert('Veuillez remplir ce champs');

}
let dataAppt = this.setDurationOpen(param);

 Inertia.post(route('appointment.store'), dataAppt, {
   onSuccess: page  => {
    if(Object.entries(page.props.errors).length === 0){
this.closeModal();
this.resetModal();
    }
    }
  });
  Inertia.on("error",event => {
    event.preventDefault();
    console.log("Nous avons cette erreur");
  })
//console.log(dataAppt);
    },
    setDurationOpen(form) {
        let dataAppt = form.date_at + ' ' + form.hour;
        let initSession = new Date(dataAppt);
const getSecondeSession = initSession.getSeconds() + form.session;

initSession.setSeconds(getSecondeSession);
        return {
            title: form.title,
            start: dataAppt,
            end: formatTime(initSession),
            session: form.session,
            user_id: form.user_id,
        };
    }
}
}


</script>

<style lang="scss" scoped>

</style>
