SELECT c.id,
    CONCAT(u.firstname, ' ', u.lastname) as name,
    r.role_name
FROM `csi_coordinator` as c,
    `csi_userdata` as u,
    `csi_role` as r
WHERE c.user_id = u.id
    and u.role = r.id
    and (
        r.role_name like '%Coordinator%' || r.role_name = 'General Secretary' || r.role_name like '%Team%'
    );