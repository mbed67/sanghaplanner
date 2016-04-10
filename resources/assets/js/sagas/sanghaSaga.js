import $ from 'jquery';
import { call, put, take } from 'redux-saga/effects';
import * as actionType from '../constants/ActionTypes';
import {
    updateNotifications,
    approveMembershipRequestFailed,
    rejectMembershipRequestFailed,
    notificationsUpdated,
    updateNotificationsForSanghaFailed
} from '../actions/sangha';

export function* approveMembershipRequest() {

    while(true) {
        // Wait for the APPROVE_MEMBERSHIP_REQUEST action
        const data  = yield take(actionType.APPROVE_MEMBERSHIP_REQUEST);
        var payload = {
            'userId': data.data.userId,
            'sanghaId': data.data.sanghaId,
            'approved': true,
            '_token': $('meta[name="csrf-token"]').attr('content')
        };

        var formData = $.param(payload);

        try {
            yield call(fetch, '/membership', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin', //to send the cookie
                headers: new Headers({
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    'X-Requested-With': 'XMLHttpRequest'
                })
            });

            yield put(updateNotifications(data.data.sanghaId));
        }
        catch (err) {
            yield put(approveMembershipRequestFailed(err));
         }
    }
}

export function* rejectMembershipRequest() {

    while(true) {
        // Wait for the REJECT_MEMBERSHIP_REQUEST action
        const data  = yield take(actionType.REJECT_MEMBERSHIP_REQUEST);
        var payload = {
            'userId': data.data.userId,
            'sanghaId': data.data.sanghaId,
            'approved': false,
            '_token': $('meta[name="csrf-token"]').attr('content')
        };

        var formData = $.param(payload);

        try {
            yield call(fetch, '/membership', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin', //to send the cookie
                headers: new Headers({
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    'X-Requested-With': 'XMLHttpRequest'
                })
            });

            yield put(updateNotifications(data.data.sanghaId));
        }
        catch (err)
        {
            yield put(rejectMembershipRequestFailed(err));
        }
    }
}

export function* updateNotificationsForSangha() {

    while(true) {
        // Wait for the UPDATE_NOTIFICATIONS action
        const data  = yield take(actionType.UPDATE_NOTIFICATIONS);

        const fetchNotifications = () => {
            return fetch('/notifications/' + data.sanghaId).then(function (response) {
                return response.json();
            })
        };

        try {
            const notifications = yield call(fetchNotifications);

            yield put(notificationsUpdated(notifications));
        }
        catch (err)
        {
            yield put(updateNotificationsForSanghaFailed(err));
        }
    }
}
