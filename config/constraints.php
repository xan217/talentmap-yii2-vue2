<?php 
return [
   "base_table" => [
      "name" => "userprofile",
      "pk" => "pk_id"
   ],
   "base_table_requirements" => [
      "tables" => [
        [
          "name" => "address",
          "pk" => "pk_id",
          "related_table_name" => "userprofile",
          "related_table_key" => "fk_address_id",
        ],
        [
          "name" => "genderType",
          "alias" => "genderT",
          "pk" => "pk_id",
          "related_table_name" => "userprofile",
          "related_table_key" => "fk_t_gender_id",
        ],
        [
          "name" => "civilStatusType",
          "alias" => "civilstatusT",
          "pk" => "pk_id",
          "related_table_name" => "userprofile",
          "related_table_key" => "fk_t_civilstatus_id",
        ]
      ],
      "constraints" => [
         [
            "table" => "userprofile",
            "field" => "status",
            "condition" => "=",
            "value" => "ACTIVO"
         ]
      ]
   ],
   "node_info" => [
      "userprofile.pk_id",
      "userprofile.name",
      "userprofile.idCard",
      "userprofile.lastname",
      "genderT.name as gender",
      "civilstatusT.name as civilStatus"
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
         "table"  => "bloodType",
         "field"  => "name",
         "join"   => "userprofile.fk_t_blood_id = bloodType.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Género",
         "table"  => "genderType",
         "field"  => "name",
         "join"   => "userprofile.fk_t_gender_id = genderType.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Estado Civil",
         "table"  => "civilStatusType",
         "field"  => "name",
         "join"   => "userprofile.fk_t_civilstatus_id = civilStatusType.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Tipo de Vivienda",
         "table"  => "homeType",
         "field"  => "name",
         "join"   => "userprofile.fk_t_home_id = homeType.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Tipo de Transporte",
         "table"  => "transportType",
         "field"  => "name",
         "join"   => "userprofile.fk_t_transport_id = transportType.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Tipo de Fumador",
         "table"  => "smokerType",
         "field"  => "name",
         "join"   => "userprofile.fk_t_smoker_id = smokerType.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Frecuencia de ingesta de alcohol",
         "table"  => "drinkerType",
         "field"  => "name",
         "join"   => "userprofile.fk_t_drinker_id = drinkerType.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "type"   => "ACQ",
         "name"   => "Tipo de empleo",
         "table"  => "employeeType",
         "field"  => "name",
         "join"   => "userprofile.fk_t_employee_id = employeeType.pk_id",
         "conditions" => []
      ],
      [
         "pk"     => "pk_id",
         "name"   => "Municipio de residencia",
         "table"  => "regionType",
         "type"   => "REL",
         "rel"    => "address",
         "field"  => "name",
         "join"   => "address.fk_t_region_id = regionType.pk_id",
         "conditions" => []
      ],
      
      [
         "pk"     => "pk_id",
         "name"   => "Ciudad de residencia",
         "table"  => "cityType",
         "type"   => "REL",
         "rel"    => "address",
         "field"  => "name",
         "join"   => "address.fk_t_city_id = cityType.pk_id",
         "conditions" => []
         /** #TODO: make a conditional constraint over another field
         'required_tables' => [
            [
               "table" => 'regiontype',
               "conditions" => [
                  "regiontype.pk_id = citytype.fk_t_region_id"
               ]
            ]
         ],
         /** */
      ],
      
   ]
];