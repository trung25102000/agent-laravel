# Terraform AWS bootstrap

## Structure

- `environments/pro/`: Terraform configuration for the production environment.
- `.gitignore`: Ignore local Terraform artifacts and secrets.

## Usage

1. `cd environments/pro`
2. Copy `terraform.tfvars.example` to `terraform.tfvars` if needed.
3. Update `aws_region`, `aws_profile`, and `s3_bucket_name` as needed.
4. If using CodePipeline, also set the related CodePipeline and CodeDeploy variables, then enable it explicitly.
5. Authenticate with AWS:
   - AWS CLI profile in `~/.aws/credentials`, or
   - environment variables such as `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, and optionally `AWS_SESSION_TOKEN`.
6. Run:

```bash
terraform init
terraform plan
```

If you use environment variables instead of an AWS CLI profile, set `aws_profile = null` or remove that line from `terraform.tfvars`.
