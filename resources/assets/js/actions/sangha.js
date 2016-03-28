import * as actionType from '../constants/ActionTypes';

export function approveMembershipRequest (userId, sanghaId, token) {
    return {
        type: actionType.APPROVE_MEMBERSHIP_REQUEST,
        data: {
            'userId': userId,
            'sanghaId': sanghaId,
            'approved': true,
            '_token': token
        }
    }
}

export function approveMembershipRequestSucceeded () {
    return {
        type: actionType.APPROVE_MEMBERSHIP_REQUEST_SUCCEEDED
    }
}

export function approveMembershipRequestFailed (err) {
    return {
        type: actionType.APPROVE_MEMBERSHIP_REQUEST_FAILED,
        err
    }
}
