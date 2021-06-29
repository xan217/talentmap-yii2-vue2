<?php 
return [
   "base_table" => [
      "name" => "userprofile",
      "pk" => "pk_id"
   ],
   "base_table_requirements" => [
      "tables" => [],
      "constraints" => [
         [
            "table" => "userprofile",
            "field" => "status",
            "condition" => "=",
            "value" => "ACTIVE"
         ]
      ]
   ],
   "node_info" => [
      "ID" => "userprofile.pk_id",
      "name" => "userprofile.name",
      "lastname" => "useprofile.lastname"
   ],
   "user_card" => [
      "personal" => [
         "userprofile.name",
         "userprofile.lastname",
         "userprofile.idCard",
         "userprofile.local_phone",
         "userprofile.phone"
      ],
      "family" => [
         "userprofile.civil_status",
         "userprofile.childNumber",
         "homeType.name"
      ],
      "health" => [
         "genderType.name",
         "bloodType.name",
         "smokerType.name",
         "drinkerType.name"
      ],
      "residence" => [
         "userprofile.livesAlone",
         "transportType.name",
         "cityType.name",
         "regionType.name",
         "address.streetType",
         "address.streetNumber",
         "address.streetChar",
         "address.streetCardinal",
         "address.intersectionNumber",
         "address.intersectionChar",
         "address.intersectionCardinal",
         "address.buildingNumber",
         "address.complement",
         "address.details"
      ],
      "development" => [
         "educationLevelType.name",
         "educationStatusType.name",
         "languageType.name",
         "employeeType.name"
      ]
   ],
   "conditions" => [
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Tipo de Sangre",
         "table"  => "bloodtype",
         "field"  => "name",
         "join"   => "userprofile.fk_t_blood_id = bloodtype.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Género",
         "table"  => "gendertype",
         "field"  => "name",
         "join"   => "userprofile.fk_t_gender_id = gendertype.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Estado Civil",
         "table"  => "civilstatustype",
         "field"  => "name",
         "join"   => "userprofile.fk_t_civilstatus_id = civilstatustype.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Tipo de Vivienda",
         "table"  => "hometype",
         "field"  => "name",
         "join"   => "userprofile.fk_t_home_id = hometype.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Tipo de Transporte",
         "table"  => "transporttype",
         "field"  => "name",
         "join"   => "userprofile.fk_t_transport_id = transporttype.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Tipo de Fumador",
         "table"  => "smokertype",
         "field"  => "name",
         "join"   => "userprofile.fk_t_smoker_id = smokertype.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Frecuencia de ingesta de alcohol",
         "table"  => "drinkertype",
         "field"  => "name",
         "join"   => "userprofile.fk_t_drinker_id = drinkertype.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Tipo de empleo",
         "table"  => "employeetype",
         "field"  => "name",
         "join"   => "userprofile.fk_t_employee_id = employeetype.pk_id",
         "conditions" => []
      ],
      /*
      [
         "name" => "Ciudad de residencia",
         "table" => "citytype",
         "type" => "REL",
         "rel" => "address",
         "field" => "name",
         "join"   => "userprofile.fk_t_employee_id = employeetype.pk_id",
         "conditions" => []
      ],
      [
         "name" => "Municipio de residencia",
         "table" => "regiontype",
         "type" => "REL",
         "rel" => "address",
         "field" => "name",
         "conditions" => []
      ]
      /** */
   ]
];