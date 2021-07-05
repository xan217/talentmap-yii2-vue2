/*****************************************************************/
/**************************** INTERFACES *************************/
/*****************************************************************/

export interface User {
   id: number | null;
   categories: {
      personal: {
         name: string,
         lastname: string,
         id_card: string,
         local_phone: string,
         phone: string
      },
      family: {
         civilstatus_type: string,
         child_number: number | null,
         employee_type: string
      },
      health:{
         blood_type: string,
         smoker_type: string,
         drinker_type: string
      },
      residence: {
         lives_alone: string,
         home_type: string,
         transport_type: string,
         address: {
            regionType: string,
            streetType: string,
            streetNumber: string,
            streetChar: string,
            streetCardinal: string,
            intersectionNumber: string,
            intersectionChar: string,
            intersectionCardinal: string,
            buildingNumber: string,
            complement: string,
            details: string
         }
      }
   }
}

export interface Searchmodel {
   blood_type: string,
   child_number: number,
   city_type: string,
   civilstatus_type: string,
   drinker_type: string,
   employee_type: string,
   educationlevel_type: string,
   gender_type: string,
   home_type: string,
   language_type: string,
   lives_alone: string,
   region_type: string,
   smoker_type: string,
   street_type: string,
   transport_type: string,
}

export interface FloatMenu {
   color: string,
   name: string,
   label: string,
   hover_open: boolean,
   direction: string,
   transition: string,
   position: string,
   icon: string
}

export interface ButtonMenu {
   action: CallableFunction,
   icon?: string,
   name?: string,
   label: string
   size: string,
   color: string,
   attrs: string
}

export interface Item {
   label: string,
   value: string
}

export interface Constraint {
   id: number,
   model: string,
   name: string,
   items: Item[]
}

/*****************************************************************/
/*************************** DEFINITIONS *************************/
/*****************************************************************/

export const userDefault = {
   id: null,
   categories: {
      personal: {
         name: "",
         lastname: "",
         id_card: "",
         local_phone: "",
         phone: ""
      },
      family: {
         civil_status: "",
         child_number: null,
         employee_type: ""
      },
      health:{
         blood_type: "",
         smoker_type: "",
         drinker_type: ""
      },
      residence: {
         lives_alone: "",
         home_type: "",
         transport_type: "",
         address: {
            regionType: "",
            streetType: "",
            streetNumber: "",
            streetChar: "",
            streetCardinal: "",
            intersectionNumber: "",
            intersectionChar: "",
            intersectionCardinal: "",
            buildingNumber: "",
            complement: "",
            details: ""
         }
      }
   }
}

export const searchmodelDefault = { 
   blood_type: "",
   child_number: null,
   city_type: "",
   civilstatus_type: "",
   drinker_type: "",
   employee_type: "",
   educationlevel_type: "",
   gender_type: "",
   home_type: "",
   language_type: "",
   lives_alone: "",
   region_type: "",
   smoker_type: "",
   street_type: "",
   transport_type: "",
}