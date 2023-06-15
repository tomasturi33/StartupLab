/* eslint-disable no-unused-vars */
import Vue from 'vue'
import VueRouter from 'vue-router'

import NotFound from '@/pages/NotFoundPage.vue'
import UNLPotencia from '@/pages/UNLPotencia/UNLPotencia.vue'
import Login from '@/pages/auth/Login.vue'
import PasswordRecovery from '@/pages/auth/PasswordRecovery.vue'
import setPasswordRecovery from '@/pages/auth/setPasswordRecovery.vue'
import Register from '@/pages/auth/Register.vue'
import Invitation from '@/pages/auth/Invitation.vue'
import InvitationVip from '@/pages/auth/InvitationVip.vue'

import Profile from '@/pages/profile/Profile.vue'

//*--------------Vistas del emprendedor -----------------*/

import CheckConvocations from '@/pages/CheckConvocations.vue'
import Home from '@/pages/entrepreneur/Home.vue'
import myEntrepreneurship from '@/pages/entrepreneur/myEntrepreneurship/myEntrepreneurship.vue'
import myStartUp from '@/pages/entrepreneur/myEntrepreneurship/myStartUp.vue'
import myEntrepreneurialTeam from '@/pages/entrepreneur/myEntrepreneurship/myTeam.vue'
import myWindow from '@/pages/entrepreneur/myEntrepreneurship/myWindow.vue'

import editProfileEntrepreneur from '@/pages/entrepreneur/myEntrepreneurship/editProfile.vue'

import Convocation from '@/pages/entrepreneur/convocation/Convocation.vue'
import myIdea from '@/pages/entrepreneur/convocation/myIdea.vue'
import showMyIdea from '@/pages/entrepreneur/convocation/showMyIdea.vue'
import showMyTeam from '@/pages/entrepreneur/convocation/showMyTeam.vue'
import myTeam from '@/pages/entrepreneur/convocation/myTeam.vue'

import editProfile from '@/pages/entrepreneur/convocation/editProfile.vue'

import preIncubationEntrepreneurship from '@/pages/entrepreneur/edition/preIncubation/preIncubation.vue'
import pillsModule from '@/pages/entrepreneur/edition/preIncubation/pills/pills.vue'

import OtherEntrepreneurships from '@/pages/entrepreneur/otherEntrepreneurships/OtherEntrepreneurships.vue'
import showOtherEntrepreneurships from '@/pages/entrepreneur/otherEntrepreneurships/showOtherEntrepreneurships.vue'
import About from '@/pages/entrepreneur/about/About.vue'

//*--------------Vistas del administrador -----------------*/

import Editions from '@/pages/admin/editions/Editions.vue'
import showEdition from '@/pages/admin/editions/showEdition.vue'
import editEdition from '@/pages/admin/editions/editEdition.vue'
import entrepreneurshipsEdition from '@/pages/admin/editions/entrepreneurships/entrepreneurshipsEdition.vue'
import newEntrepreneurshipEdition from '@/pages/admin/editions/entrepreneurships/newEntrepreneurshipEdition.vue'
import showConvocationFormEdition from '@/pages/admin/editions/entrepreneurships/show/showConvocationFormEdition.vue'
import showEntrepreneurshipsEdition from '@/pages/admin/editions/entrepreneurships/show/showEntrepreneurshipsEdition.vue'

import showConvocationFormAccepted from '@/pages/admin/editions/entrepreneurships/show/entrepreneurship/showConvocationFormAccepted.vue'
import showEntrepreneurshipAccepted from '@/pages/admin/editions/entrepreneurships/show/entrepreneurship/showEntrepreneurshipAccepted.vue'
import showTeamAccepted from '@/pages/admin/editions/entrepreneurships/show/entrepreneurship/showTeamAccepted.vue'
import showWindowAccepted from '@/pages/admin/editions/entrepreneurships/show/entrepreneurship/showWindowAccepted.vue'
import showModulesPreIncubations from '@/pages/admin/editions/entrepreneurships/show/entrepreneurship/showModulesPreIncubations.vue'
import showModulePreIncubation from '@/pages/admin/editions/entrepreneurships/show/entrepreneurship/showModulePreIncubation.vue'

// import preIncubation from'@/pages/admin/editions/stages/preIncubation/modules/Modules.vue'
import modules from'@/pages/admin/editions/stages/preIncubation/modules/Modules.vue'
import showModule from '@/pages/admin/editions/stages/preIncubation/modules/show.vue'
import newModule from '@/pages/admin/editions/stages/preIncubation/modules/newModule.vue'
import editModule from '@/pages/admin/editions/stages/preIncubation/modules/editModule.vue'

import pills from'@/pages/admin/editions/stages/preIncubation/pills/pills.vue'
import newPill from'@/pages/admin/editions/stages/preIncubation/pills/newPill.vue'
import showPill from'@/pages/admin/editions/stages/preIncubation/pills/showPill.vue'
import editPill from'@/pages/admin/editions/stages/preIncubation/pills/editPill.vue'

import Entrepreneurships from '@/pages/admin/entrepreneurships/Entrepreneurships.vue'
import showEntrepreneurships from '@/pages/admin/entrepreneurships/showEntrepreneurship/showEntrepreneurships.vue'
import showEntrepreneurshipsConvocationForm from '@/pages/admin/entrepreneurships/showEntrepreneurship/showEntrepreneurshipsConvocationForm'
import showEntrepreneurshipsStartup from '@/pages/admin/entrepreneurships/showEntrepreneurship/showEntrepreneurshipsStartup'
import showEntrepreneurshipsTeam from '@/pages/admin/entrepreneurships/showEntrepreneurship/showEntrepreneurshipsTeam'
import showEntrepreneurshipsWindow from '@/pages/admin/entrepreneurships/showEntrepreneurship/showEntrepreneurshipsWindow.vue'
import showEntrepreneurshipsWindowWall from '@/pages/admin/entrepreneurships/showEntrepreneurship/showEntrepreneurshipsWindowWall.vue'

import Evaluators from '@/pages/admin/evaluator/Evaluators.vue'
import ModuleAssigned from '@/pages/admin/evaluator/moduleAssigned.vue'

import Tutors from '@/pages/admin/tutor/tutors.vue'
import EntrepreneurshipsAssignedTutors from '@/pages/admin/tutor/moduleAssigned.vue'

import Users from '@/pages/admin/users/Users.vue'
import Entrepreneurs from '@/pages/admin/entrepreneurs/Entrepreneurs.vue'

import Config from '@/pages/admin/config/Config.vue'
import AcademicUnits from '@/pages/admin/config/AcademicUnits.vue'
import Careers from '@/pages/admin/config/Careers.vue'
import VerticalWorks from '@/pages/admin/config/VerticalWorks.vue'
import EntrepreneurshipNeed from '@/pages/admin/config/EntrepreneurshipNeed.vue'
import Provincias from '@/pages/admin/config/Provincias.vue'
import Localidades from '@/pages/admin/config/Localidades.vue'

//*--------------Vistas del Evaluador -----------------*/

import EntrepreneurshipsAssignedEvaluator from '@/pages/evaluator/EntrepreneurshipsAssigned.vue'
import EntrepreneurshipTasksEvaluator from '@/pages/evaluator/EntrepreneurshipTasks.vue'
import EntrepreneurshipTasksModuleEvaluator from '@/pages/evaluator/EntrepreneurshipTasksModule.vue'

import showStartUpEvaluator from '@/pages/evaluator/show/showStartUp.vue'
import showStartUpTeamEvaluator from '@/pages/evaluator/show/showTeam.vue'
import showStartupWindowEvaluator from '@/pages/evaluator/show/showWindow.vue'

import ModulesPreIncubation from '@/pages/evaluator/modules/ModulesPreIncubation.vue'
import ModulePreIncubation from '@/pages/evaluator/modules/ModulePreIncubation.vue'


//*--------------Vistas del Tutor -----------------*/

import EntrepreneurshipsAssignedTutor from '@/pages/tutor/EntrepreneurshipsAssigned.vue'
import EntrepreneurshipTasksTutor from '@/pages/tutor/EntrepreneurshipTasks.vue'
import EntrepreneurshipTasksModuleTutor from '@/pages/tutor/EntrepreneurshipTasksModule.vue'

import showStartUpTutor from '@/pages/tutor/show/showStartUp.vue'
import showStartUpTeamTutor from '@/pages/tutor/show/showTeam.vue'
import showStartupWindowTutor from '@/pages/tutor/show/showWindow.vue'

Vue.use(VueRouter)

const routes= [
    {
      path: '/',
      name: 'UNLPotencia',
      component: UNLPotencia
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/password-recovery',
      name: 'PasswordRecovery',
      component: PasswordRecovery
    },
    {
      path: '/password-recovery/:url',
      name: 'setPasswordRecovery',
      component: setPasswordRecovery
    },
    {
      path: '/register/:slug',
      name: 'register',
      component: Register
    },
    {
      path: '/check-convocations',
      name: 'CheckConvocations',
      component: CheckConvocations,
      meta: {
        auth: true
      }
    },
    {
      path: '/invitation/:url',
      name: 'Invitation',
      component: Invitation
    },
    {
      path: '/invitation-vip/:url',
      name: 'InvitationVip',
      component: InvitationVip
    },
    {
      path: '/profile',
      name: 'profile',
      component: Profile,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Editar cuenta'
          }
        ]
      }
    },
    {
      path: '/home',
      name: 'home',
      component: Home,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          }
        ]
      }
    },

    //------------------------------------
    //---------- Convocatoria ------------
    //------------------------------------

    {
      path: '/convocation',
      name: 'convocation',
      component: Convocation,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Formulario de convocatoria'
          }
        ]
      }
    },
    {
      path: '/convocation/my-idea',
      name: 'my-idea',
      component: myIdea,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Formulario de convocatoria',
            to: { name: 'convocation' }
          },
          {
            text: 'Mi Idea'
          }
        ]
      }
    },
    {
      path: '/convocation/my-team',
      name: 'myTeam',
      component: myTeam,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Formulario de convocatoria',
            to: { name: 'convocation' }
          },
          {
            text: 'Mi Equipo'
          }
        ]
      }
    },
    {
      path: '/convocation/my-team/my-profile',
      name: 'editProfile',
      component: editProfile,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Formulario de convocatoria',
            to: { name: 'convocation' }
          },
          {
            text: 'Mi Equipo',
            to: { name: 'myTeam' }
          },
          {
            text: 'Mi perfíl'
          }
        ]
      }
    },
    {
      path: '/convocation/show-my-idea',
      name: 'showMyIdea',
      component: showMyIdea,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Formulario de convocatoria',
            to: { name: 'convocation' }
          },
          {
            text: 'Mi Idea'
          }
        ]
      }
    },
    {
      path: '/convocation/show-my-team',
      name: 'showMyTeam',
      component: showMyTeam,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Formulario de convocatoria',
            to: { name: 'convocation' }
          },
          {
            text: 'Mi equipo'
          }
        ]
      }
    },
    
    //------------------------------------
    //---------- Emprendimiento ----------
    //------------------------------------

    {
      path: '/my-entrepreneurship',
      name: 'myEntrepreneurship',
      component: myEntrepreneurship,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Mi Emprendimiento'
          }
        ]
      }
    },
    {
      path: '/my-entrepreneurship/my-startup',
      name: 'myStartUp',
      component: myStartUp,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Mi Emprendimiento',
            to: { name: 'myEntrepreneurship' }
          },
          {
            text: 'Mi StartUp'
          }
        ]
      }
    },
    {
      path: '/my-entrepreneurship/my-team',
      name: 'myEntrepreneurialTeam',
      component: myEntrepreneurialTeam,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Mi Emprendimiento',
            to: { name: 'myEntrepreneurship' }
          },
          {
            text: 'Mi Equipo'
          }
        ]
      }
    },
    {
      path: '/my-entrepreneurship/my-team/my-profile',
      name: 'editProfileEntrepreneur',
      component: editProfileEntrepreneur,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Mi Emprendimiento',
            to: { name: 'myEntrepreneurship' }
          },
          {
            text: 'Mi Equipo',
            to: { name: 'myEntrepreneurialTeam' }
          },
          {
            text: 'Mi Perfíl'
          }
        ]
      }
    },
    {
      path: '/my-entrepreneurship/my-window',
      name: 'myWindow',
      component: myWindow,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Mi Emprendimiento',
            to: { name: 'myEntrepreneurship' }
          },
          {
            text: 'Mi Vidriera'
          }
        ]
      }
    },
    
    {
      path: '/home/pre-incubation',
      name: 'preIncubationEntrepreneurship',
      component: preIncubationEntrepreneurship,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Pre Incubación'
          }
        ]
      }
    },
    {
      path: '/home/pre-incubation/module/:slug',
      name: 'pillsModule',
      component: pillsModule,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Pre Incubación',
            to: { name: 'preIncubationEntrepreneurship'}
          },
          {
            text: 'Módulo'
          }
        ]
      }
    },
    {
      path: '/other-entrepreneurships',
      name: 'otherentrepreneurships',
      component: OtherEntrepreneurships,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Otros Emprendimientos'
          }
        ]
      }
    },
    {
      path: '/other-entrepreneurships/view/:slug',
      name: 'showotherentrepreneurships',
      component: showOtherEntrepreneurships,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Otros Emprendimientos',
            to: { name: 'otherentrepreneurships' }
          },
          {
            text: 'Ver'
          }
        ]
      }
    },
    {
      path: '/about',
      name: 'about',
      component: About,
      meta: {
        auth: true,
        role: 'entrepreneur', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Acerca de UNLPotencia'
          }
        ]
      }
    },
    {
      path: '/admin/editions',
      name: 'editions',
      component: Editions,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id',
      name: 'showEdition',
      component: showEdition,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Ver'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/edit',
      name: 'editEdition',
      component: editEdition,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Editar'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/entrepreneurships',
      name: 'entrepreneurshipsEdition',
      component: entrepreneurshipsEdition,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/entrepreneurships/new',
      name: 'newEntrepreneurshipEdition',
      component: newEntrepreneurshipEdition,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurshipsEdition'}
          },
          {
            text: 'Nuevo'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/convocation-form/:convocation_form_id',
      name: 'showConvocationFormEdition',
      component: showConvocationFormEdition,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurshipsEdition' }
          },
          {
            text: 'Ver'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/entrepreneurships/:entrepreneurship_id',
      name: 'showEntrepreneurshipsEdition',
      component: showEntrepreneurshipsEdition,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurshipsEdition' }
          },
          {
            text: 'Ver'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/entrepreneurships/:entrepreneurship_id/convocation-form/:convocation_form_id',
      name: 'showConvocationFormAccepted',
      component: showConvocationFormAccepted,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurshipsEdition' }
          },
          {
            text: 'Ver',
            to: { name: 'showEntrepreneurshipsEdition' }
          },
          {
            text: 'Formularaio de convocatoria'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/entrepreneurships/:entrepreneurship_id/show-entrepreneurship',
      name: 'showEntrepreneurshipAccepted',
      component: showEntrepreneurshipAccepted,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurshipsEdition' }
          },
          {
            text: 'Ver',
            to: { name: 'showEntrepreneurshipsEdition' }
          },
          {
            text: 'StartUp'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/entrepreneurships/:entrepreneurship_id/show-team/:convocation_form_id',
      name: 'showTeamAccepted',
      component: showTeamAccepted,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurshipsEdition' }
          },
          {
            text: 'Ver',
            to: { name: 'showEntrepreneurshipsEdition' }
          },
          {
            text: 'Equipo emprendedor'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/entrepreneurships/:entrepreneurship_id/show-window/:convocation_form_id',
      name: 'showWindowAccepted',
      component: showWindowAccepted,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurshipsEdition' }
          },
          {
            text: 'Ver',
            to: { name: 'showEntrepreneurshipsEdition' }
          },
          {
            text: 'Vidriera'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/entrepreneurships/:entrepreneurship_id/show-modules-pre-incubation',
      name: 'showModulesPreIncubations',
      component: showModulesPreIncubations,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurshipsEdition' }
          },
          {
            text: 'Ver',
            to: { name: 'showEntrepreneurshipsEdition' }
          },
          {
            text: 'Modulos pre-incubación'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/entrepreneurships/:entrepreneurship_id/show-modules-pre-incubation/:module_pre_incubation_id',
      name: 'showModulePreIncubation',
      component: showModulePreIncubation,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurshipsEdition' }
          },
          {
            text: 'Ver',
            to: { name: 'showEntrepreneurshipsEdition' }
          },
          {
            text: 'Modulos pre-incubación',
            to: { name: 'showModulesPreIncubations' }
          },
          {
            text: 'Ver'
          }
        ]
      }
    },
    
    {
      path: '/admin/editions/:edition_id/edit/pre-incubation',
      name: 'modules',
      component: modules,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Editar',
            to: { name: 'editEdition' }
          },
          {
            text: 'Pre Incubación'
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/edit/pre-incubation/:id_module',
      name: 'showModule',
      component: showModule,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Editar',
            to: { name: 'editEdition' }
          },
          {
            text: 'Pre Incubación',
            to: { name: 'modules' }
          },
          {
            text: 'Ver',
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/edit/pre-incubation/new-module',
      name: 'newModule',
      component: newModule,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Editar',
            to: { name: 'editEdition' }
          },
          {
            text: 'Pre Incubación',
            to: { name: 'modules' }
          },
          {
            text: 'Nuevo',
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/edit/pre-incubation/:id_module/edit',
      name: 'editModule',
      component: editModule,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Editar',
            to: { name: 'editEdition' }
          },
          {
            text: 'Pre Incubación',
            to: { name: 'modules' }
          },
          {
            text: 'Editar',
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/edit/pre-incubation/:module_id/pills',
      name: 'pills',
      component: pills,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Editar',
            to: { name: 'editEdition' }
          },
          {
            text: 'Pre Incubación',
            to: { name: 'modules' }
          },
          {
            text: 'Pildoras',
          }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/edit/pre-incubation/:module_id/pills/new',
      name: 'newPill',
      component: newPill,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Editar',
            to: { name: 'editEdition' }
          },
          {
            text: 'Pre Incubación',
            to: { name: 'modules' }
          },
          {
            text: 'Pildoras',
            to: { name: 'pills' }
          },
          {
            text: 'Nueva',
           }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/edit/pre-incubation/:module_id/pills/show/:pill_id',
      name: 'showPill',
      component: showPill,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Editar',
            to: { name: 'editEdition' }
          },
          {
            text: 'Pre Incubación',
            to: { name: 'modules' }
          },
          {
            text: 'Pildoras',
            to: { name: 'pills' }
          },
          {
            text: 'Ver',
           }
        ]
      }
    },
    {
      path: '/admin/editions/:edition_id/edit/pre-incubation/:module_id/pills/edit/:pill_id',
      name: 'editPill',
      component: editPill,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Ediciones',
            to: { name: 'editions' }
          },
          {
            text: 'Editar',
            to: { name: 'editEdition' }
          },
          {
            text: 'Pre Incubación',
            to: { name: 'modules' }
          },
          {
            text: 'Pildoras',
            to: { name: 'pills' }
          },
          {
            text: 'Editar',
           }
        ]
      }
    },
    {
      path: '/admin/entrepreneurships',
      name: 'entrepreneurships',
      component: Entrepreneurships,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Emprendimientos'
          }
        ]
      }
    },
    {
      path: '/admin/entrepreneurships/:id',
      name: 'showEntrepreneurships',
      component: showEntrepreneurships,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurships' }
          },
          {
            text: 'Ver'
          }
        ]
      }
    },
    {
      path: '/admin/entrepreneurships/:id/convocation-form',
      name: 'showEntrepreneurshipsConvocationForm',
      component: showEntrepreneurshipsConvocationForm,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurships' }
          },
          {
            text: 'Ver',
            to: { name: 'showEntrepreneurships' }
          },
          {
            text: 'Formulario de la convocatoria'
          }
        ]
      }
    },
    {
      path: '/admin/entrepreneurships/:id/startup',
      name: 'showEntrepreneurshipsStartup',
      component: showEntrepreneurshipsStartup,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurships' }
          },
          {
            text: 'Ver',
            to: { name: 'showEntrepreneurships' }
          },
          {
            text: 'StartUp'
          }
        ]
      }
    },
    {
      path: '/admin/entrepreneurships/:id/team',
      name: 'showEntrepreneurshipsTeam',
      component: showEntrepreneurshipsTeam,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurships' }
          },
          {
            text: 'Ver',
            to: { name: 'showEntrepreneurships' }
          },
          {
            text: 'Integrantes'
          }
        ]
      }
    },
    {
      path: '/admin/entrepreneurships/:id/window',
      name: 'showEntrepreneurshipsWindow',
      component: showEntrepreneurshipsWindow,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurships' }
          },
          {
            text: 'Ver vidriera'
          }
        ]
      }
    },
    {
      path: '/admin/entrepreneurships/:id/window-wall',
      name: 'showEntrepreneurshipsWindowWall',
      component: showEntrepreneurshipsWindowWall,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Emprendimientos',
            to: { name: 'entrepreneurships' }
          },
          {
            text: 'Vidriera'
          }
        ]
      }
    },
    {
      path: '/admin/entrepreneurs',
      name: 'entrepreneurs',
      component: Entrepreneurs,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Emprendedores'
          }
        ]
      }
    },
    {
      path: '/admin/evaluators',
      name: 'evaluators',
      component: Evaluators,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Evaluadores',
          }
        ]
      }
    },
    {
      path: '/admin/evaluators/module-assigned/:evaluator_id',
      name: 'moduleAssigned',
      component: ModuleAssigned,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Evaluadores',
            to: { name: 'evaluators' }
          },
          {
            text: 'Proyectos asignados'
          }
        ]
      }
    },
    {
      path: '/admin/tutors',
      name: 'tutors',
      component: Tutors,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Tutores',
          }
        ]
      }
    },
    {
      path: '/admin/tutors/module-assigned/:tutor_id',
      name: 'entrepreneurshipsAssignedTutors',
      component: EntrepreneurshipsAssignedTutors,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Tutores',
            to: { name: 'tutors' }
          },
          {
            text: 'Proyectos asignados'
          }
        ]
      }
    },
    {
      path: '/admin/users',
      name: 'users',
      component: Users,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Usuarios',
          }
        ]
      }
    },
    {
      path: '/admin/config',
      name: 'config',
      component: Config,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Configuración'
          }
        ]
      }
    },
    {
      path: '/admin/config/academic-units',
      name: 'academicUnits',
      component: AcademicUnits,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Configuración',
            to: { name: 'config'}
          },
          {
            text: 'Unidades Académicas'
          }
        ]
      }
    },
    {
      path: '/admin/config/careers',
      name: 'careers',
      component: Careers,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Configuración',
            to: { name: 'config'}
          },
          {
            text: 'Carreras'
          }
        ]
      }
    },
    {
      path: '/admin/config/vertical-works',
      name: 'verticalWorks',
      component: VerticalWorks,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Configuración',
            to: { name: 'config'}
          },
          {
            text: 'Verticales de Trabajo'
          }
        ]
      }
    },
    {
      path: '/admin/config/entrepreneurship-needs',
      name: 'entrepreneurshipNeed',
      component: EntrepreneurshipNeed,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Configuración',
            to: { name: 'config'}
          },
          {
            text: 'Necesidades de los Emprendimientos'
          }
        ]
      }
    },
    {
      path: '/admin/config/provincias',
      name: 'provincias',
      component: Provincias,
      meta: {
        auth: true,
        role: 'admin', 
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Configuración',
            to: { name: 'config'}
          },
          {
            text: 'Provincias'
          }
        ]
      }
    },
    {
      path: '/admin/config/localidades',
      name: 'localidades',
      component: Localidades,
      meta: {
        auth: true,
        role: 'admin',
        breadCrumb: [
          {
            text: 'Home',
            to: { name: 'home' }
          },
          {
            text: 'Configuración',
            to: { name: 'config'}
          },
          {
            text: 'Localidades'
          }
        ]
      }
    },
    //-----------------------------------------------------------//
    //------------------------EVALUADOR--------------------------//
    //-----------------------------------------------------------//
    {
      path: '/evaluator/entrepreneurships-assigned',
      name: 'EntrepreneurshipsAssignedEvaluator',
      component: EntrepreneurshipsAssignedEvaluator,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados'
          }
        ]
      }
    },
    {
      path: '/evaluator/entrepreneurships-assigned/:slug',
      name: 'EntrepreneurshipTasksEvaluator',
      component: EntrepreneurshipTasksEvaluator,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedEvaluator'}
          },
          {
            text: 'Tareas'
          }
        ]
      }
    },
    {
      path: '/evaluator/entrepreneurships-assigned/:slug/module/:module_pre_incubation_id/tasks',
      name: 'entrepreneurshipTasksModuleEvaluator',
      component: EntrepreneurshipTasksModuleEvaluator,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedEvaluator'}
          },
          {
            text: 'Tareas',
            to: { name: 'EntrepreneurshipTasksEvaluator'}
          },
          {
            text: 'Ver',
          }
        ]
      }
    },
    {
      path: '/evaluator/entrepreneurships-assigned/:slug/startup',
      name: 'showStartUpEvaluator',
      component: showStartUpEvaluator,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedEvaluator'}
          },
          {
            text: 'Tareas',
            to: { name: 'EntrepreneurshipTasksEvaluator'}
          },
          {
            text: 'Ver StartUp',
          }
        ]
      }
    },
    {
      path: '/evaluator/entrepreneurships-assigned/:slug/team',
      name: 'showStartUpTeamEvaluator',
      component: showStartUpTeamEvaluator,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedEvaluator'}
          },
          {
            text: 'Tareas',
            to: { name: 'EntrepreneurshipTasksEvaluator'}
          },
          {
            text: 'Ver equipo',
          }
        ]
      }
    },
    {
      path: '/evaluator/entrepreneurships-assigned/:slug/window',
      name: 'showStartupWindowEvaluator',
      component: showStartupWindowEvaluator,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedEvaluator'}
          },
          {
            text: 'Tareas',
            to: { name: 'EntrepreneurshipTasksEvaluator'}
          },
          {
            text: 'Ver vidriera',
          }
        ]
      }
    },
    {
      path: '/evaluator/modules',
      name: 'ModulesPreIncubation',
      component: ModulesPreIncubation,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Modúlos'
          }
        ]
      }
    },
    {
      path: '/evaluator/modules/:slug',
      name: 'ModulePreIncubation',
      component: ModulePreIncubation,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Modúlos',
            to: { name: 'ModulesPreIncubation'}
          },
          {
            text: 'ver modúlos'
          }
        ]
      }
    },

    //-----------------------------------------------------------//
    //--------------------------TUTOR----------------------------//
    //-----------------------------------------------------------//
    {
      path: '/tutor/entrepreneurships-assigned',
      name: 'EntrepreneurshipsAssignedTutor',
      component: EntrepreneurshipsAssignedTutor,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados'
          }
        ]
      }
    },
    {
      path: '/tutor/entrepreneurships-assigned/:slug',
      name: 'EntrepreneurshipTasksTutor',
      component: EntrepreneurshipTasksTutor,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedTutor'}
          },
          {
            text: 'Tareas'
          }
        ]
      }
    },
    {
      path: '/tutor/entrepreneurships-assigned/:slug/module/:module_pre_incubation_id/tasks',
      name: 'entrepreneurshipTasksModuleTutor',
      component: EntrepreneurshipTasksModuleTutor,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedTutor'}
          },
          {
            text: 'Tareas',
            to: { name: 'EntrepreneurshipTasksTutor'}
          },
          {
            text: 'Ver',
          }
        ]
      }
    },
    {
      path: '/tutor/entrepreneurships-assigned/:slug/startup',
      name: 'showStartUpTutor',
      component: showStartUpTutor,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedTutor'}
          },
          {
            text: 'Tareas',
            to: { name: 'EntrepreneurshipTasksTutor'}
          },
          {
            text: 'Ver StartUp',
          }
        ]
      }
    },
    {
      path: '/tutor/entrepreneurships-assigned/:slug/team',
      name: 'showStartUpTeamTutor',
      component: showStartUpTeamTutor,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedTutor'}
          },
          {
            text: 'Tareas',
            to: { name: 'EntrepreneurshipTasksTutor'}
          },
          {
            text: 'Ver equipo',
          }
        ]
      }
    },
    {
      path: '/tutor/entrepreneurships-assigned/:slug/window',
      name: 'showStartupWindowTutor',
      component: showStartupWindowTutor,
      meta: {
        auth: true,
        role: 'evaluator',
        breadCrumb: [
          {
            text: 'Emprendimientos asignados',
            to: { name: 'EntrepreneurshipsAssignedTutor'}
          },
          {
            text: 'Tareas',
            to: { name: 'EntrepreneurshipTasksTutor'}
          },
          {
            text: 'Ver vidriera',
          }
        ]
      }
    },
    
    { path: '*', component: NotFound }
  ]

  const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
    scrollBehavior(to, from, savedPosition) {
      // always scroll to top
      document.getElementById('app').scrollIntoView({ behavior: 'smooth' });
    },
  })

  router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')
    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
      next('/login')
      return
    }
    next()
  })
  
  export default router