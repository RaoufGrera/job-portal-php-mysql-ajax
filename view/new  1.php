FROM job_description
			join job_employer on job_employer.user_id = job_description.user_id
			join job_company on job_employer.comp_id =job_company.comp_id
			left join job_city on job_description.city_id =job_city.city_id 
			left join job_type on job_type.type_id = job_description.type_id
			left join job_domain on job_domain.domain_id = job_description.domain_id
			left join job_status on job_status.status_id = job_description.status_id
			left join job_ed_type on job_ed_type.edt_id = job_description.edt_id
			left join job_nat on job_nat.nat_id = job_description.nat_id 
			left join job_salary on job_salary.salary_id = job_description.salary_id
			WHERE job_description.job_start <= CURDATE() 
			AND job_description.job_end >= CURDATE() 
			AND job_description.is_active = 0 
			AND job_company.block_admin = 0  ";