<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package    mod
 * @subpackage ucicbootstrap
 * @copyright  2014 Birmingham City University <michael.grant@bcu.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

defined('MOODLE_INTERNAL') || die;


define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @global object
 * @param object $ucicbootstrap
 * @return bool|int
 */
function ucicbootstrap_add_instance($ucicbootstrap) {
    global $DB;

    $ucicbootstrap->timemodified = time();
    return $DB->insert_record("ucicbootstrap", $ucicbootstrap);
}

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @global object
 * @param object $ucicbootstrap
 * @return bool
 */
function ucicbootstrap_update_instance($ucicbootstrap) {
    global $DB;

    $ucicbootstrap->timemodified = time();
    $ucicbootstrap->id = $ucicbootstrap->instance;

    return $DB->update_record("ucicbootstrap", $ucicbootstrap);
}

/**
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @global object
 * @param int $id
 * @return bool
 */
function ucicbootstrap_delete_instance($id) {
    global $DB;

    if (! $ucicbootstrap = $DB->get_record("ucicbootstrap", array("id" => $id))) {
        return false;
    }

    $result = true;

    if (! $DB->delete_records("ucicbootstrap", array("id" => $ucicbootstrap->id))) {
        $result = false;
    }

    return $result;
}

/**
 * Given a course_module object, this function returns any
 * "extra" information that may be needed when printing
 * this activity in a course listing.
 * See get_array_of_activities() in course/lib.php
 *
 * @global object
 * @param object $coursemodule
 * @return cached_cm_info|null
 */
function ucicbootstrap_get_coursemodule_info($coursemodule) {
    global $DB;

    if ($ucicbootstrap = $DB->get_record('ucicbootstrap', array('id' => $coursemodule->instance),
            'id, name, intro, introformat, title, bootstraptype, bootstrapicon')) {

        if (!$ucicbootstrap->name || $ucicbootstrap->name == 'ucicbootstrap') {
            $ucicbootstrap->name = "ucicbootstrap".$ucicbootstrap->id;
            $DB->set_field('ucicbootstrap', 'name', $ucicbootstrap->name, array('id' => $ucicbootstrap->id));
        }

        $course = $DB->get_record('course',  array('id' => $coursemodule->course));

        $info = new cached_cm_info();
        // No filtering hre because this info is cached and filtered later.

        switch($ucicbootstrap->bootstraptype) {
            case 0:
                $info->content = ucicbootstrap_modal_outline($ucicbootstrap->name, $ucicbootstrap->title,
                        format_module_intro('ucicbootstrap', $ucicbootstrap, $coursemodule->id, false), $ucicbootstrap->bootstrapicon).
                        ucicbootstrap_modal_button($ucicbootstrap->name, $ucicbootstrap->title, $ucicbootstrap->bootstrapicon,$coursemodule,$ucicbootstrap,$course);
            break;

            case 1:
                $info->content = ucicbootstrap_toggle_outline($ucicbootstrap->name, $ucicbootstrap->title,
                        format_module_intro('ucicbootstrap', $ucicbootstrap, $coursemodule->id, false), $ucicbootstrap->bootstrapicon);
            break;

            case 2:
                $info->content = ucicbootstrap_standard($ucicbootstrap->name, $ucicbootstrap->title,
                        format_module_intro('ucicbootstrap', $ucicbootstrap, $coursemodule->id, false), $ucicbootstrap->bootstrapicon);
            break;

            case 3:
                $info->content = ucicbootstrap_blockquote($ucicbootstrap->name, $ucicbootstrap->title,
                        format_module_intro('ucicbootstrap', $ucicbootstrap, $coursemodule->id, false), $ucicbootstrap->bootstrapicon);
            break;
        }

        $info->name  = $ucicbootstrap->name;
        return $info;
    } else {
        return null;
    }
}

/**
 * This function is used by the reset_course_userdata function in moodlelib.
 *
 * @param object $data the data submitted from the reset course.
 * @return array status array
 */
function ucicbootstrap_reset_userdata($data) {
    return array();
}

/**
 * Returns all other caps used in module
 *
 * @return array
 */
function ucicbootstrap_get_extra_capabilities() {
    return array('moodle/site:accessallgroups');
}

/**
 * @uses FEATURE_IDNUMBER
 * @uses FEATURE_GROUPS
 * @uses FEATURE_GROUPINGS
 * @uses FEATURE_GROUPMEMBERSONLY
 * @uses FEATURE_MOD_INTRO
 * @uses FEATURE_COMPLETION_TRACKS_VIEWS
 * @uses FEATURE_GRADE_HAS_GRADE
 * @uses FEATURE_GRADE_OUTCOMES
 * @param string $feature FEATURE_xx constant for requested feature
 * @return bool|null True if module supports feature, false if not, null if doesn't know
 */
function ucicbootstrap_supports($feature) {
    switch($feature) {
        case FEATURE_IDNUMBER:                return false;
        case FEATURE_GROUPS:                  return false;
        case FEATURE_GROUPINGS:               return false;
        case FEATURE_GROUPMEMBERSONLY:        return true;
        case FEATURE_MOD_INTRO:               return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS: return true;
        case FEATURE_GRADE_HAS_GRADE:         return false;
        case FEATURE_GRADE_OUTCOMES:          return false;
        case FEATURE_MOD_ARCHETYPE:           return MOD_ARCHETYPE_RESOURCE;
        case FEATURE_BACKUP_MOODLE2:          return true;
        case FEATURE_NO_VIEW_LINK:            return true;

        default: return null;
    }
}

function ucicbootstrap_standard($name, $title, $content, $icon) {
    $output = html_writer::start_tag('div');


    $output .= html_writer::tag('h4',
        html_writer::tag('i', '', array(
            'class' => 'fa ' . $icon,
            'style' => 'font-size: 24px; color: #ff0000; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin-right: 0.75rem; flex-shrink: 0;'
        )) .
        html_writer::tag('span', $title, array(
            'style' => 'line-height: 1.4; margin-top: 8px;'
        )),
        array(
            'class' => 'activity-style-header mb-3',
            'style' => 'display: flex; align-items: flex-start; font-size: 1rem; font-weight: 500; margin: 0;'
        )
    );


    //$output .= html_writer::tag('h4', '<i class="fa '.$icon.'"></i>'.$title);


    $output .=  html_writer::div(
        html_writer::div(
            $content,
            'ratio ratio-16x9',
            array('style' => 'max-width: 800px; width: 100%;')
        ),
        'd-flex justify-content-center mb-3'
    );


    //$output .= html_writer::tag('div', $content);

    $output .= html_writer::end_tag('div');

    return $output;
}

function ucicbootstrap_toggle_outline($togglename, $toggletitle, $togglecontent, $icon) {
    $output = html_writer::start_tag('div', array(
        'class' => 'mod-ucicbootstrap-toggle'
    ));

    $output .= html_writer::start_tag('div', array(
        'class' => 'panel-heading'
    ));

    $output .= html_writer::start_tag('h4', array(
        'class' => 'panel-title'
    ));

    $output .= html_writer::tag('a', '<i class="fa '.$icon.'"></i>'.$toggletitle, array(
        'data-toggle' => 'collapse',
        'class' => 'accordion-toggle collapsed',
        'href' => '#'.$togglename
    ));

    $output .= html_writer::end_tag('h4');

    $output .= html_writer::end_tag('div');

    $output .= html_writer::start_tag('div', array(
        'id' => $togglename,
        'class' => 'panel-collapse collapse'
    ));

    $output .= html_writer::tag('div', $togglecontent, array(
        'class' => 'panel-body'
    ));

    $output .= html_writer::end_tag('div');

    $output .= html_writer::end_tag('div');

    return $output;
}

function ucicbootstrap_modal_outline($modalname, $modaltitle, $modalcontent, $icon) {
    $output = html_writer::start_tag('div', array(
        'id' => $modalname,
        'class' => 'modal fade',
        'role' => 'dialog',
        'aria-labelledby' => 'myModalLabel',
        'aria-hidden' => 'true'
    ));

    $output .= html_writer::start_tag('div', array(
        'class' => 'modal-dialog'
    ));

    $output .= html_writer::start_tag('div', array(
        'class' => 'modal-content'
    ));

    $output .= html_writer::start_tag('div', array(
        'class' => 'modal-header'
    ));

    $output .= html_writer::start_tag('h4', array(
        'class' => 'modal-title'
    ));

    $output .= '<i class="fa '.$icon.'"></i>';

    $output .= $modaltitle;

    $output .= html_writer::end_tag('h4');

    $output .= html_writer::end_tag('div');

    $output .= html_writer::start_tag('div', array(
        'class' => 'modal-body'
    ));

    $output .= $modalcontent;

    $output .= html_writer::end_tag('div');

    $output .= html_writer::start_tag('div', array(
        'class' => 'modal-footer'
    ));

    $output .= html_writer::start_tag('button', array(
        'type' => 'button',
        'class' => 'btn btn-default',
        'data-dismiss' => 'modal'
    ));

    $output .= 'Close';

    $output .= html_writer::end_tag('button');

    $output .= html_writer::end_tag('div');

    $output .= html_writer::end_tag('div');

    $output .= html_writer::end_tag('div');

    $output .= html_writer::end_tag('div');

    $output .= html_writer::start_tag('div', array(
        'class' => 'text-center'
    ));

    return $output;
}

function ucicbootstrap_modal_button($modalname, $modaltitle, $icon, $coursemodule = null, $ucicbootstrap = null, $course = null) {

    $data = json_encode(array($coursemodule, $ucicbootstrap, $course));

    //$encrypted_data = mc_encrypt($data, ENCRYPTION_KEY);

    $output = html_writer::start_tag('a', array(
        'class' => 'activity-link',//btn btn-primary btn-lg',
        'data-toggle' => 'modal',
        'data-target' => '#'.$modalname,
        //'data-info' => $encrypted_data,
    ));
    $output .= '<i class="fa '.$icon.'"></i>';
    $output .= '<span class="instancename">' . $modaltitle . '</span>';
    $output .= html_writer::end_tag('a');
    $output .= html_writer::end_tag('div');
    return $output;
}

// Encrypt Function
/*function mc_encrypt($encrypt, $key){
    $encrypt = serialize($encrypt);
    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
    $key = pack('H*', $key);
    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
    $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
    return $encoded;
}*/

function ucicbootstrap_blockquote($name, $title, $content, $icon) {
    $output = html_writer::start_tag('blockquote');

    $output .= html_writer::tag('h4', '<i class="fa '.$icon.'"></i>'.$title);

    $output .= $content;

    $output .= html_writer::end_tag('blockquote');
    return $output;
}
