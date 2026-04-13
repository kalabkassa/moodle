defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/externallib.php");

class local_lms_external extends external_api {

    public static function update_section_parameters() {
        return new external_function_parameters([
            'courseid' => new external_value(PARAM_INT),
            'sectionnum' => new external_value(PARAM_INT),
            'name' => new external_value(PARAM_TEXT),
        ]);
    }

    public static function update_section($courseid, $sectionnum, $name) {
        global $DB;

        // Validate params
        $params = self::validate_parameters(
            self::update_section_parameters(),
            [
                'courseid' => $courseid,
                'sectionnum' => $sectionnum,
                'name' => $name,
            ]
        );

        // Get section
        $section = $DB->get_record('course_sections', [
            'course' => $courseid,
            'section' => $sectionnum
        ], '*', MUST_EXIST);

        // Update name
        $section->name = $name;

        $DB->update_record('course_sections', $section);

        return [
            'status' => 'success',
            'sectionid' => $section->id,
        ];
    }

    public static function update_section_returns() {
        return new external_single_structure([
            'status' => new external_value(PARAM_TEXT),
            'sectionid' => new external_value(PARAM_INT),
        ]);
    }
}
