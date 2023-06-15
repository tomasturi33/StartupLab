<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;

class CareersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //----------------------------------------------------------------
        // Unidad academica ID: 1
        // Unidad academica: Centro Universitario Reconquista – Avellaneda
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>1, 'name' => 'Tecnicatura Universitaria en Tecnología de Alimentos', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>1, 'name' => 'Ciclo de Licenciatura en Ciencia y Tecnología de los Alimentos', 'state'=> 1]);

        //----------------------------------------------------------------
        // Unidad academica ID: 2
        // Unidad academica: Centro Universitario Gálvez
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>2, 'name' => 'Análisis Universitario de Alimentos', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>2, 'name' => 'Tecnicatura Universitaria en Gastronomía', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>2, 'name' => 'Licenciatura en Ciencia y Tecnología de los Alimentos', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>2, 'name' => 'Licenciatura en Enfermería', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>2, 'name' => 'Tecnicatura Universitaria en Biocombustibles', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>2, 'name' => 'Tecnicatura Universitaria en Elaboración y Producción de Alimentos', 'state'=> 1]);

        //----------------------------------------------------------------
        // Unidad academica ID: 3
        // Unidad academica:Sede UNL Rafaela – Sunchales
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>3, 'name' => 'Licenciatura en Obstetricia, que se dicta en la Sede Rafaela y en CET Atilra', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>3, 'name' => 'Técnico Universitario en Automatización y Robótica', 'state'=> 1]);




        //----------------------------------------------------------------
        // Unidad academica ID: 4
        // Unidad academica:Facultad de Arquitectura, Diseño y Urbanismo
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>4, 'name' => 'Técnico en Composición de Parques y Jardines', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>4, 'name' => 'Técnico en Diseño de Mobiliario', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>4, 'name' => 'Técnico en Interiorismo y Decoración', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>4, 'name' => 'Arquitectura y Urbanismo', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>4, 'name' => 'Ciclo de Licenciatura en Artes Visuales', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>4, 'name' => 'Licenciatura en Diseño de la Comunicación Visual', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>4, 'name' => 'Licenciatura en Diseño Industrial', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>4, 'name' => 'Arquitectura y Urbanismo', 'state'=> 1]);



        //----------------------------------------------------------------
        // Unidad academica ID: 5
        // Unidad academica: Facultad de Bioquímica y Ciencias Biológicas
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Bioquímica', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Licenciatura en Biotecnología', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Licenciatura en Nutrición', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Licenciatura en Saneamiento Ambiental', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Licenciatura en Higiene y Seguridad en el Trabajo', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Licenciatura en Administración de la Salud', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Licenciatura en Terapia Ocupacional', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Licenciatura en Ciencias y Tecnología de los Alimentos', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Tecnicatura en Administración de Salud', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Tecnicatura en Higiene y Seguridad en el Trabajo', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Tecnicatura Universitaria en Salud Ambiental', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>5, 'name' => 'Licenciatura en Educación Física', 'state'=> 1]);

        //----------------------------------------------------------------
        // Unidad academica ID: 6
        // Unidad academica: Facultad de Ciencias Agrarias
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>6, 'name' => 'Tecnicatura en Administración de Empresas Agropecuaria', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>6, 'name' => 'Tecnicatura en Gestión y Producción Apícola', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>6, 'name' => 'Tecnicatura en Producción Primaria de Leche', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>6, 'name' => 'Tecnicatura en Poscosecha de Granos y Semillas.', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>6, 'name' => 'Ingeniería Agronómica', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 7
        // Unidad academica: Facultad de Ciencias Económicas
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>7, 'name' => 'Contador Público Nacional', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>7, 'name' => 'Licenciatura en Administración', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>7, 'name' => 'Licenciatura en Economía', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>7, 'name' => 'Tecnicatura en Administración y Gestión Pública', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>7, 'name' => 'Tecnicatura Universitaria en Control y Auditoría Gubernamental', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>7, 'name' => 'Bachiller', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 8
        // Unidad academica: Facultad de Ciencias Jurídicas y Sociales
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>8, 'name' => 'Bibliotecología', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>8, 'name' => 'Criminología y Seguridad Ciudadana', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>8, 'name' => 'Martillero Público y Corredor de Comercio', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>8, 'name' => 'Abogacía', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>8, 'name' => 'Licenciatura en Trabajo Social', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 9
        // Unidad academica: Facultad de Ciencias Médicas
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>9, 'name' => 'Ciclo de Licenciatura en Producción de BioImágenes', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>9, 'name' => 'Licenciatura en Obstetricia', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>9, 'name' => 'Medicina', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>9, 'name' => 'Técnicatura Universitaria en Cosmiatría y Cosmetología', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>9, 'name' => 'Tecnicatura Universitaria en Emergencia Prehospitalaria, Rescate y Trauma', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 10
        // Unidad academica: Facultad de Ciencias Veterinarias
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>10, 'name' => 'Tecnicatura en Higiene y Seguridad Alimentaria', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>10, 'name' => 'Tecnicatura en Alimentación de Ganado Vacuno', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>10, 'name' => 'Tecnicatura en Producción Primaria de Leche', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>10, 'name' => 'Medicina Veterinaria', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 11 
        // Unidad academica: Facultad de Humanidades y Ciencias
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Letras', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Licenciatura en Biodiversidad', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Profesorado en Biologia', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Profesorado de Geografía', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Licenciatura en Geografía', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Licenciatura en Historia', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Profesorado en Matematicas', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Licenciatura en Sociología', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Licenciatura en Ciencia Politica', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Profesorado en Química', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>11, 'name' => 'Licenciatura en Trabajo Social', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 12
        // Unidad academica: Facultad de Ingeniería Química
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Analista Industrial', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Químico Analistal', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Ingeniería Química', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Ingeniería Industrial', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Licenciatura en Química', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Licenciatura en Matemática Aplicada', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Ingeniería Ambiental', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Profesorado en Química', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Licenciatura en Física', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Ingeniería en alimentos', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Ingeniería en materiales', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Ingenieria en materiales', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>12, 'name' => 'Licenciatura en ciencias y tecnología de alimentos', 'state'=> 1]);



        //----------------------------------------------------------------
        // Unidad academica ID: 13
        // Unidad academica: Facultad de Ingenieria y Ciencias Hidricas
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Ingeniería Ambiental', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Ingeniería en Agrimensura', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Ingeniería en Informática', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Ingeniería en Recursos Hídricos', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Analista en Informática', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Perito Topocartógrafo', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Tecnico Universitario en Automatización y Robótica', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Tecnicatura en Informática de Gestión', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Tecnicatura en Informática Aplicada a la Gráfica y Animación Digital', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Tecnicatura en Informática Aplicada al Diseño Multimedia y de Sitios Web', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Tecnicatura en Diseño y Programación de Videojuegos', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Tecnicatura Universitaria en Software Libre', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>13, 'name' => 'Doctorado en Física', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 14
        // Unidad academica: Escuela Superior de Sanidad “Ramón Carrillo”
        //----------------------------------------------------------------
        // No hay ninguna registrada, pedirle al equipo de potencia que averiguen
        //Career::create([ 'academic_unit_id'=>14, 'name' => '', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 15
        // Unidad academica: Instituto Superior de Música
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Profesorado de Música', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Canto', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Clarinete', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Composición', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientacion en Contrabajo', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Dirección Coral', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Dirección Orquestal', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Flauta', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Guitarra', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Percusión', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Piano', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Saxofón', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Trombóne', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientacion en Viola', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Violín', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música con orientación en Violoncello', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Música Popular', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Lic. en Sonorización y Grabación', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Tec. en Composición con Medios Electroacústicos', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Tecnicatura en Arreglos Musicales', 'state'=> 1]);
        Career::create([ 'academic_unit_id'=>15, 'name' => 'Ciclo de Licenciatura en Teoría y Crítica de la Música', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 16
        // Unidad academica: Escuela Industrial Superior
        //----------------------------------------------------------------
        // No hay ninguna registrada, pedirle al equipo de potencia que averiguen
        //Career::create([ 'academic_unit_id'=>16, 'name' => '', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID:17
        // Unidad academica: Escuela de Agricultura, Ganadería y Granja
        //----------------------------------------------------------------
        Career::create([ 'academic_unit_id'=>17, 'name' => 'Tecnico en Producción Agropecuaria', 'state'=> 1]);


        //----------------------------------------------------------------
        // Unidad academica ID: 18
        // Unidad academica: Escuela Industrial Superior
        //----------------------------------------------------------------
        // No hay ninguna registrada, pedirle al equipo de potencia que averiguen
        //Career::create([ 'academic_unit_id'=>18, 'name' => '', 'state'=> 1]);


    }
}
