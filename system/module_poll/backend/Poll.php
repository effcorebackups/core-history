<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

namespace effcore;

abstract class Poll {

    static function select($id) {
        return (new Instance('poll', ['id' => $id]))->select();
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    static function answers_by_poll_id_select($id_poll) {
        $result = [];
        $rows = Entity::get('poll_answer')->instances_select([
            'where' => [
                'id_poll_!f'       => 'id_poll',
                'id_poll_operator' => '=',
                'id_poll_!v'       => $id_poll]]);
        foreach ($rows as $c_row)
            $result[$c_row->id] = $c_row;
        return $result;
    }

    static function answer_insert($id_poll, $answer, $weight = 0) {
        return (new Instance('poll_answer', [
            'id_poll' => $id_poll,
            'answer'  => $answer,
            'weight'  => $weight
        ]))->insert();
    }

    static function answer_delete($id_answer) {
        return (new Instance('poll_answer', [
            'id' => $id_answer
        ]))->delete();
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    static function votes_total_select($id_answers) {
        return Entity::get('poll_vote')->instances_select_count([
            'where' => [
                'id_answer_!f'                => 'id_answer',
                'id_answer_in_operator_begin' => 'in (',
                'id_answer_in_value_!v'       => $id_answers,
                'id_answer_in_operator_end'   => ')'
        ]]);
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    static function votes_id_total_by_answers_select($id_answers) {
        $result = [];
        $rows = Entity::get('poll_vote')->instances_select([
            'fields' => [
                'id_answer_!f' => 'id_answer',
                'count' => [
                    'function_begin' => 'count(',
                    'function_field' => '*',
                    'function_end'   => ')',
                    'alias_begin'    => 'as',
                    'alias_!f'       => 'total']],
            'where' => [
                'id_answer_!f'                => 'id_answer',
                'id_answer_in_operator_begin' => 'in (',
                'id_answer_in_value_!v'       => $id_answers,
                'id_answer_in_operator_end'   => ')'],
            'group' => [
                'id_answer_!f' => 'id_answer']]);
        foreach ($rows as $c_row)
            $result[$c_row->id_answer] =
                    $c_row->total;
        return $result;
    }

    static function votes_id_by_user_id_select($id_user, $id_answers) {
        $result = [];
        $rows = Entity::get('poll_vote')->instances_select([
            'where' => [
                'conjunction_!and' => [
                    'id_user' => [
                        'id_user_!f'       => 'id_user',
                        'id_user_operator' => '=',
                        'id_user_!v'       => $id_user],
                    'id_answer' => [
                        'id_answer_!f'                => 'id_answer',
                        'id_answer_in_operator_begin' => 'in (',
                        'id_answer_in_value_!v'       => $id_answers,
                        'id_answer_in_operator_end'   => ')']]]]);
        foreach ($rows as $c_row)
            $result[$c_row->id_answer] =
                    $c_row->id_answer;
        return $result;
    }

    static function votes_id_by_session_id_select($id_session, $id_answers) {
        $result = [];
        $rows = Entity::get('poll_vote')->instances_select([
            'where' => [
                'conjunction_!and' => [
                    'id_session' => [
                        'id_session_!f'       => 'id_session',
                        'id_session_operator' => '=',
                        'id_session_!v'       => $id_session],
                'id_answer' => [
                    'id_answer_!f'                => 'id_answer',
                    'id_answer_in_operator_begin' => 'in (',
                    'id_answer_in_value_!v'       => $id_answers,
                    'id_answer_in_operator_end'   => ')']]]]);
        foreach ($rows as $c_row)
            $result[$c_row->id_answer] =
                    $c_row->id_answer;
        return $result;
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    static function votes_by_user_id_insert($id_user, $id_answer) {
        return (new Instance('poll_vote', [
            'id_user'   => $id_user,
            'id_answer' => $id_answer
        ]))->insert();
    }

    static function votes_by_session_id_insert($id_session, $id_answer) {
        return (new Instance('poll_vote', [
            'id_session' => $id_session,
            'id_answer'  => $id_answer
        ]))->insert();
    }

    # ◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦◦

    static function votes_by_user_id_delete($id_user, $id_answers) {
        return Entity::get('poll_vote')->instances_delete([
            'where' => [
                'conjunction_!and' => [
                    'id_user' => [
                        'id_user_!f'       => 'id_user',
                        'id_user_operator' => '=',
                        'id_user_!v'       => $id_user],
                    'id_answer' => [
                        'id_answer_!f'                => 'id_answer',
                        'id_answer_in_operator_begin' => 'in (',
                        'id_answer_in_value_!v'       => $id_answers,
                        'id_answer_in_operator_end'   => ')'
        ]]]]);
    }

    static function votes_by_session_id_delete($id_session, $id_answers) {
        return Entity::get('poll_vote')->instances_delete([
            'where' => [
                'conjunction_!and' => [
                    'id_session' => [
                        'id_session_!f'       => 'id_session',
                        'id_session_operator' => '=',
                        'id_session_!v'       => $id_session],
                    'id_answer' => [
                        'id_answer_!f'                => 'id_answer',
                        'id_answer_in_operator_begin' => 'in (',
                        'id_answer_in_value_!v'       => $id_answers,
                        'id_answer_in_operator_end'   => ')'
        ]]]]);
    }

}
