import axios from "axios";

export const redirectNow = (url) => {
    window.location.href = url;
};

export const awardJob = (jobId, userId) => {
    return new Promise((resolve, reject) => {
        axios
            .post(`/api/jobs/award/${jobId}`, { userId })
            .then((res) => {
                resolve(res.data);
            })
            .catch((err) => {
                reject(err);
            });
    });
};

export const acceptVideo = (videoId, userId) => {
    //pass in videoId and userId
};

export const getInfluencerDetails = (userId) => {
    return new Promise((resolve, reject) => {
        axios
            .get(`/api/influencers/${userId}`)
            .then((res) => {
                resolve(res.data);
            })
            .catch((err) => {
                reject(err);
            });
    });
};

export const getInfluencerDetailsViaJob = (JobId) => {
    return new Promise((resolve, reject) => {
        axios
            .get(`/api/influencers/job/${JobId}/awarded`)
            .then((res) => {
                resolve(res.data);
            })
            .catch((err) => {
                reject(err);
            });
    });
};