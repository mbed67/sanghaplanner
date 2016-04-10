import * as actionType from '../constants/ActionTypes';

export function approveMembershipRequest(id, userId, sanghaId) {
        return {
            type: actionType.APPROVE_MEMBERSHIP_REQUEST,
            data: {
                'id': id,
                'userId': userId,
                'sanghaId': sanghaId
            }
        }
    }

export function updateNotifications(sanghaId) {
    return {
        type: actionType.UPDATE_NOTIFICATIONS,
        sanghaId: sanghaId
    }
}

export function approveMembershipRequestFailed(err) {
    return {
        type: actionType.APPROVE_MEMBERSHIP_REQUEST_FAILED,
        err
    }
}

export function rejectMembershipRequest(id, userId, sanghaId) {
    return {
        type: actionType.REJECT_MEMBERSHIP_REQUEST,
        data: {
            'id': id,
            'userId': userId,
            'sanghaId': sanghaId
        }
    }
}

export function rejectMembershipRequestFailed(err) {
    return {
        type: actionType.REJECT_MEMBERSHIP_REQUEST_FAILED,
        err
    }
}

export function notificationsUpdated(data) {
    return {
        type: actionType.NOTIFICATIONS_UPDATED,
        data: data
    }
}

export function updateNotificationsForSanghaFailed(err) {
    return {
        type: actionType.UPDATE_NOTIFICATIONS_FOR_SANGHA_FAILED,
        err
    }
}
