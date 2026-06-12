# PRO Terraform

1. Copy `terraform.tfvars.example` to `terraform.tfvars`.
2. Update `aws_region`, `aws_profile`, `s3_bucket_name`, and CodePipeline variables if needed.
3. Authenticate with AWS using `~/.aws/credentials` or environment variables.
4. Run `terraform init`.
5. Run `terraform plan`.
6. Run `terraform apply` to create the bucket and generate `s3/info.txt`.

Set `enable_codepipeline = true` only after filling:
- `codepipeline_role_arn`
- `codedeploy_application_name`
- `codedeploy_deployment_group_name`

If you use environment variables instead of an AWS CLI profile, set `aws_profile = null` or remove that line from `terraform.tfvars`.
