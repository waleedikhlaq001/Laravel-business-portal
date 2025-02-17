/**
 * External Dependencies
 */
 import React, { StrictMode, useState, useEffect, lazy, Suspense } from "react";
 import { render } from "react-dom";
 import Skeleton from "react-loading-skeleton";
 import "react-loading-skeleton/dist/skeleton.css";
 /**
  * Internal Dependencies
  */
 const Jobs = lazy(() => import("./job") /* webpackChunkName: "jobs" */);
 import JobProvider from "./JobProvider";
 export default function Index() {
     const [jobs, setJobs] = useState([]);
     const [searchQuery, setSearchQuery] = useState("");
     const [filter, setFilter] = useState(false);
     const [filterList, setFilterList] = useState({
         location: null,
         category: null,
         type: null,
         AvgPrice: null,
         AvgHrRate: null,
         duration: null,
         projType: null,
     });
 
     //handle initial loading of jobs
     useEffect(() => {
         if (!filter) {
             const fetchJobs = async () => {
                 const response = await fetch(availableJobsEndpoint);
                 const json = await response.json();
                 setJobs(json.data);
             };
 
             fetchJobs();
         }
     }, []);
 
     useEffect(() => {
         /**
          * if filter is true, fetch jobs based on filter
          */
         if (filter && !searchQuery) {
             console.log(filter, searchQuery);
             let queryPath = "";
             for (let q in filterList) {
                 if (filterList[q] != null) {
                     queryPath += `&${q}=${filterList[q]}`;
                 }
             }
             console.log("filter is true and search query is empty");
             const fetchJobs = async () => {
                 //use obj => filterList to filter search
                 const response = await fetch(
                     `${availableJobsEndpoint}?${queryPath}`
                 );
                 const json = await response.json();
                 setJobs(json.data);
                 // setJobs([]); //to test that it works
             };
 
             fetchJobs();
         }
 
         /**
          * if filter is true and searchQuery is not empty, fetch jobs based on searchQuery and filter
          */
         if (filter && searchQuery) {
             console.log("filter is true and search query is not empty");
             let queryPath = "";
             for (let q in filterList) {
                 if (filterList[q] != null) {
                     queryPath += `&${q}=${filterList[q]}`;
                 }
             }
             console.log("query path is", queryPath);
             const fetchJobs = async () => {
                 //use obj => filterList to filter search
                 const response = await fetch(
                     `${availableJobsEndpoint}?${queryPath}&search=${searchQuery}`
                 );
                 const json = await response.json();
                 setJobs(json.data);
             };
 
             fetchJobs();
         }
 
         if (searchQuery && !filter) {
             const fetchJobs = async () => {
                 const response = await fetch(
                     `${availableJobsEndpoint}?search=${searchQuery}`
                 );
                 const json = await response.json();
                 setJobs(json.data);
             };
 
             fetchJobs();
         }
     }, [filter, filterList, searchQuery]);
 
     //handle search query
     // useEffect(() => {}, [searchQuery]);
 
     //handle filter
     useEffect(() => {
         //if filter is true
         const checkFilter = async () => {
             const filterCount = await Object.values(filterList).filter(
                 (v) => v != null
             ).length;
 
             if (filterCount === 0) {
                 setFilter(false);
             }
 
             if (filterCount > 0) {
                 console.log("filterCount", filterCount);
                 setFilter(true);
             }
         };
 
         checkFilter();
     }, [filterList]);
 
     return (
         <JobProvider
             jobs={jobs}
             filter={filter}
             setFilter={setFilter}
             filterList={filterList}
             setFilterList={setFilterList}
             searchQuery={searchQuery}
             setSearchQuery={setSearchQuery}
         >
             <div>
                 <Suspense
                     fallback={
                         <div>
                             <h1>{<Skeleton />}</h1>
                             {<Skeleton count={10} />}
                         </div>
                     }
                 >
                     <Jobs jobs={jobs} />
                 </Suspense>
             </div>
         </JobProvider>
     );
 }
 
 if (
     document.querySelector("#jobSearch-module") != undefined &&
     currentJobs != undefined
 ) {
     render(
         <StrictMode>
             <Index />
         </StrictMode>,
         document.querySelector("#jobSearch-module")
     );
 }