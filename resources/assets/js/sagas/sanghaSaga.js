import $ from 'jquery';
import { call, put, take } from 'redux-saga/effects';
import * as actionType from '../constants/ActionTypes';
import {
    updateNotifications,
    updateMembers,
    approveMembershipRequestFailed,
    rejectMembershipRequestFailed,
    notificationsUpdated,
    membersUpdated,
    updateNotificationsForSanghaFailed,
    updateMembersForSanghaFailed,
    createRetreatForSangha,
    createRetreatForSanghaFailed,
    updateRetreatsForSangha,
    retreatsUpdated,
    updateRetreatsForSanghaFailed
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
            yield put(updateMembers(data.data.sanghaId));
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
            return fetch('/notifications/' + data.sanghaId, {
                credentials: 'same-origin'
            }).then(function (response) {
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

export function* updateMembersForSangha() {

    while(true) {
        // Wait for the UPDATE_MEMBERS action
        const data  = yield take(actionType.UPDATE_MEMBERS);

        const fetchMembers = () => {
            return fetch('/sanghas/' + data.sanghaId + '/members', {
                credentials: 'same-origin'
            }).then(function (response) {
                return response.json();
            })
        };

        try {
            const members = yield call(fetchMembers);

            yield put(membersUpdated(members));
        }
        catch (err)
        {
            yield put(updateMembersForSanghaFailed(err));
        }
    }
}

export function* toggleRole() {

    while(true) {
        // Wait for the TOGGLE_ROLE action
        const data  = yield take(actionType.TOGGLE_ROLE);
        var payload = {
            'userId': data.data.userId,
            'sanghaId': data.data.sanghaId,
            '_token': $('meta[name="csrf-token"]').attr('content')
        };

        var formData = $.param(payload);

        try {
            yield call(fetch, '/updatemembership', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin', //to send the cookie
                headers: new Headers({
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    'X-Requested-With': 'XMLHttpRequest'
                })
            });

            yield put(updateMembers(data.data.sanghaId));
        }
        catch (err) {
            console.log('error toggling Role');
        }
    }
}

export function* removeMember() {

    while(true) {
        // Wait for the TOGGLE_ROLE action
        const data  = yield take(actionType.REMOVE_MEMBER);
        var payload = {
            'userId': data.data.userId,
            'sanghaIdToUnjoin': data.data.sanghaId,
            '_token': $('meta[name="csrf-token"]').attr('content')
        };

        var formData = $.param(payload);

        try {
            yield call(fetch, '/membership/remove', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin', //to send the cookie
                headers: new Headers({
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    'X-Requested-With': 'XMLHttpRequest'
                })
            });

            yield put(updateMembers(data.data.sanghaId));
        }
        catch (err) {
            console.log('error removing member');
        }
    }
}

export function* createRetreat() {

    while(true) {
        const data  = yield take(actionType.CREATE_RETREAT);
        var payload = {
            'sanghaId': data.data.sanghaId,
            'description': data.data.description,
            'retreatStart': data.data.retreatStart,
            'retreatEnd': data.data.retreatEnd,
            '_token': $('meta[name="csrf-token"]').attr('content')
        };

        var formData = $.param(payload);

        try {
            yield call(fetch, '/sanghas' + data.sanghaId + '/retreats/create', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin', //to send the cookie
                headers: new Headers({
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    'X-Requested-With': 'XMLHttpRequest'
                })
            });

            yield put(updateRetreats(data.data.sanghaId));
        }
        catch (err) {
            yield put(createRetreatForSanghaFailed(err));
        }
    }
}

export function* updateRetreats() {

    while(true) {
        const data  = yield take(actionType.UPDATE_RETREATS);

        const fetchRetreats = () => {
            return fetch('/sanghas/' + data.sanghaId + '/retreats', {
                credentials: 'same-origin'
            }).then(function (response) {
                return response.json();
            })
        };

        try {
            const retreats = yield call(fetchRetreats);

            yield put(retreatsUpdated(retreats));
        }
        catch (err)
        {
            yield put(updateRetreatsForSanghaFailed(err));
        }
    }
}
