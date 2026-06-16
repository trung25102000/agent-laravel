# PRO Terraform

1. Copy `terraform.tfvars.example` to `terraform.tfvars`.
2. Update `aws_region`, `aws_profile`, `s3_bucket_name`, and CodePipeline variables if needed.
3. If the S3 bucket already exists, set `create_s3_bucket = false` in `terraform.tfvars`.
4. Authenticate with AWS using `~/.aws/credentials` or environment variables.
5. Run `terraform init`.
6. Run `terraform plan`.
7. Run `terraform apply` to create or reuse the bucket and generate `s3/info.txt`.

Set `enable_codepipeline = true` only after filling:
- `codepipeline_role_name`
- `codedeploy_application_name`
- `codedeploy_deployment_group_name`
- `codedeploy_target_tag_key`
- `codedeploy_target_tag_value`

Set `enable_ec2 = true` only after filling:
- `ec2_ami_id`
- `ec2_subnet_id`
- `ec2_vpc_security_group_ids`

The Terraform setup now creates:
- IAM roles for CodePipeline and CodeDeploy via the `IAM` module
- a `Server` CodeDeploy application
- a CodeDeploy deployment group
- an optional EC2 instance via the `EC2` module

The deployment group targets EC2 instances by tag filter, so your target instances must carry the configured tag key/value.

If you use environment variables instead of an AWS CLI profile, set `aws_profile = null` or remove that line from `terraform.tfvars`.
