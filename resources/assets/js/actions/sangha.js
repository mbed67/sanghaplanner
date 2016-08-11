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

export function updateMembers(sanghaId) {
    return {
        type: actionType.UPDATE_MEMBERS,
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

export function membersUpdated(data) {
    return {
        type: actionType.MEMBERS_UPDATED,
        data: data
    }
}

export function updateMembersForSanghaFailed(err) {
    return {
        type: actionType.UPDATE_MEMBERS_FOR_SANGHA_FAILED,
        err
    }
}

export function toggleRole(userId, sanghaId) {
    return {
        type: actionType.TOGGLE_ROLE,
        data: {
            userId: userId,
            sanghaId: sanghaId
        }
    }
}

export function removeMember(userId, sanghaId) {
    return {
        type: actionType.REMOVE_MEMBER,
        data: {
            userId: userId,
            sanghaId: sanghaId
        }
    }
}

export function createRetreatForSangha(sanghaId, description, retreatStart, retreatEnd) {
    return {
        type: actionType.CREATE_RETREAT,
        sanghaId: sanghaId,
        description: description,
        retreatStart: retreatStart,
        retreatEnd: retreatEnd
    }
}

export function updateRetreatsForSangha(sanghaId) {
    return {
        type: actionType.UPDATE_RETREATS,
        sanghaId: sanghaId
    }
}

export function retreatsUpdated(data) {
    return {
        type: actionType.RETREATS_UPDATED,
        data: data
    }
}

export function updateRetreatsForSanghaFailed(err) {
    return {
        type: actionType.UPDATE_RETREATS_FOR_SANGHA_FAILED,
        err
    }
}

export function createRetreatForSanghaFailed(err) {
    return {
        type: actionType.CREATE_RETREAT_FOR_SANGHA_FAILED,
        err
    }
}

export function showCreateRetreatModal(modalType, sanghaId) {
    return {
        type: actionType.SHOW_MODAL,
        modalType: modalType,
        sanghaId: sanghaId
    }
}

export function hideModal(modalType) {
    return {
        type: actionType.HIDE_MODAL,
        modalType: modalType
    }
}
