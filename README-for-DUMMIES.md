# PRP Commands for Dummies 🏗️
*Building Software Like a Master Architect*

## What is This Thing?

Imagine you want to build a house. You wouldn't just grab a hammer and start hitting wood, right? You'd hire an architect to draw plans, a structural engineer to figure out the foundation, and skilled builders to follow the blueprints.

**The PRP Framework works exactly the same way for building software.**

Instead of randomly writing code and hoping it works, you use specialized "AI construction workers" who follow detailed blueprints to build your software features correctly the first time.

---

## The Construction Crew Analogy 🏢

Think of the PRP commands as different specialists in a construction company:

### **🏗️ The Master Architect** (`/prp-planning-create`)
- **What they do:** Take your vague idea ("I want a nice house") and create detailed architectural plans with blueprints, materials list, and construction phases
- **When to use:** When you have a rough idea but need comprehensive planning
- **Example:** "I want users to be able to like posts" → Complete feature specification with diagrams

### **📋 The Structural Engineer** (`/api-contract-define`) 
- **What they do:** Create detailed specifications for how different parts connect (like how the foundation connects to the walls)
- **When to use:** After the architect creates plans, when you need frontend and backend to work together
- **Example:** Defines exactly how the "like button" talks to the database

### **📐 The Detail Architect** (`/prp-base-create`)
- **What they do:** Create incredibly detailed construction manuals with every nail, screw, and measurement specified
- **When to use:** When you need comprehensive implementation instructions
- **Example:** Step-by-step instructions for building the entire like button feature

### **🔧 The Renovation Specialist** (`/prp-spec-create`)
- **What they do:** Plan how to change existing buildings (like converting a garage into a bedroom)
- **When to use:** When you need to modify existing code rather than build something new
- **Example:** Changing from simple authentication to OAuth2

### **✅ The Project Foreman** (`/prp-task-create`)
- **What they do:** Create focused daily work orders with quality checks
- **When to use:** For small, specific tasks that need careful execution
- **Example:** "Add a dark mode toggle to the settings page"

### **🔨 The Master Builder** (`/prp-base-execute`)
- **What they do:** Actually build the entire feature following the detailed plans
- **When to use:** After you have comprehensive building plans
- **Example:** Takes the like button plans and builds the working feature

### **🏠 The Renovation Team** (`/prp-spec-execute`)
- **What they do:** Execute renovation plans, carefully transforming existing structures
- **When to use:** After you have renovation specifications
- **Example:** Actually migrates your authentication system

### **⚡ The Specialist Crew** (`/prp-task-execute`)
- **What they do:** Handle focused tasks with surgical precision
- **When to use:** After you have specific task lists
- **Example:** Adds the dark mode toggle exactly as specified

### **🏃‍♂️ The Emergency Response Team** (`/task-list-init`)
- **What they do:** Create rapid action plans for urgent situations
- **When to use:** Hackathons, urgent fixes, or when you need to move fast
- **Example:** "Build a social dashboard in 2 days"

---

## The Magic: How They Work Together 🔗

**This is the KEY part that makes everything work!**

Just like real construction, each specialist builds on the work of the previous one:

```
🏗️ Master Architect creates building plans
    ↓ (Plans get passed to...)
📋 Structural Engineer creates connection specs  
    ↓ (Both plans and specs get passed to...)
📐 Detail Architect creates construction manual
    ↓ (Manual gets passed to...)
🔨 Master Builder builds the actual feature
```

**IMPORTANT:** Each step uses the output from previous steps - they're not isolated tools!

---

## The Step-by-Step Process 📋

### **For Building New Features (Most Common)**

**Step 1: Get the Big Picture**
```bash
/prp-planning-create "user profile page with avatar upload and bio editing"
```
- Creates: `PRPs/user-profile-prd.md` (architectural plans)
- Contains: Complete feature specification, user flows, technical architecture

**Step 2: Define How Parts Connect**  
```bash
/api-contract-define "create API endpoints for the user profile feature described in PRPs/user-profile-prd.md"
```
- Creates: `PRPs/contracts/user-profile-api-contract.md` (connection specs)
- Contains: Exact API endpoints, data structures, error handling

**Step 3: Create Detailed Instructions**
```bash
/prp-base-create "implement user profile feature using PRPs/user-profile-prd.md architecture and PRPs/contracts/user-profile-api-contract.md specifications"
```
- Creates: `PRPs/user-profile-implementation.md` (construction manual)
- Contains: Step-by-step implementation with all context needed

**Step 4: Build It**
```bash
/prp-base-execute PRPs/user-profile-implementation.md
```
- Result: Working user profile feature with all tests passing

---

### **For Changing Existing Code**

**Step 1: Plan the Changes**
```bash
/prp-spec-create "migrate user authentication from basic auth to OAuth2 with Google integration"
```
- Creates: `SPEC_PRP/PRPs/oauth2-migration.md` (renovation plans)
- Contains: Current state, desired state, transformation steps

**Step 2: Execute the Changes**
```bash
/prp-spec-execute SPEC_PRP/PRPs/oauth2-migration.md
```
- Result: Authentication system successfully migrated

---

### **For Small, Focused Tasks**

**Step 1: Define the Task**
```bash
/prp-task-create "add email validation to the signup form with proper error messages"
```
- Creates: `TASK_PRP/PRPs/email-validation.md` (work order)
- Contains: Specific tasks with validation and rollback plans

**Step 2: Do the Task**
```bash
/prp-task-execute TASK_PRP/PRPs/email-validation.md
```
- Result: Email validation added with proper testing

---

### **For Emergency/Fast Work**

**Step 1: Create Action Plan**
```bash
/task-list-init "hackathon project: social media dashboard with posts, likes, and user profiles"
```
- Creates: `PRPs/checklist.md` (emergency action plan)
- Contains: Prioritized task list with status tracking

**Step 2: Execute Manually**
- Follow the checklist, checking off items as you complete them
- Use other commands for specific parts if needed

---

## Complete Real Example: Building a "Like Button" 💖

Let's build a social media like button from scratch, step by step:

### **Step 1: The Master Architect Does Their Magic** 🏗️
```bash
/prp-planning-create "social media like button with real-time updates and analytics tracking"
```

**What happens behind the scenes:**
- AI researches existing like button implementations
- Creates user flow diagrams
- Designs database schema for likes
- Plans real-time update architecture
- Specifies analytics requirements
- Creates comprehensive PRD document

**Result:** `PRPs/like-button-prd.md` with complete architectural plans

---

### **Step 2: The Structural Engineer Creates Connection Specs** 📋
```bash
/api-contract-define "create API contracts for the like button feature specified in PRPs/like-button-prd.md, including real-time updates and analytics"
```

**What happens behind the scenes:**
- Reads the architectural plans from Step 1
- Defines specific API endpoints:
  - `POST /api/posts/{id}/like`
  - `DELETE /api/posts/{id}/like`  
  - `GET /api/posts/{id}/likes/analytics`
- Creates TypeScript interfaces
- Specifies WebSocket events for real-time updates
- Defines error responses

**Result:** `PRPs/contracts/like-button-api-contract.md` with exact technical specifications

---

### **Step 3: The Detail Architect Creates the Construction Manual** 📐
```bash
/prp-base-create "implement like button feature using architecture from PRPs/like-button-prd.md and API specifications from PRPs/contracts/like-button-api-contract.md"
```

**What happens behind the scenes:**
- Reads BOTH the architectural plans AND the API contracts
- Researches the existing codebase for patterns
- Creates step-by-step implementation plan
- Includes all necessary context (documentation links, code examples)
- Defines 4-level quality checking process
- Creates comprehensive construction manual

**Result:** `PRPs/like-button-implementation.md` with everything needed to build it

---

### **Step 4: The Master Builder Constructs the Feature** 🔨
```bash
/prp-base-execute PRPs/like-button-implementation.md
```

**What happens behind the scenes:**
- **Planning Phase:** Creates detailed todo list using TodoWrite
- **Foundation (Level 1):** 
  - Creates database migration for likes table
  - Sets up TypeScript interfaces
  - Runs syntax checking: `ruff check --fix && mypy .`
- **Structure (Level 2):**
  - Implements API endpoints following the contract
  - Creates React component with proper state management
  - Adds comprehensive unit tests
  - Runs tests: `uv run pytest tests/ -v`
- **Systems (Level 3):**
  - Integrates WebSocket for real-time updates
  - Connects frontend to backend APIs
  - Tests complete user workflows
  - Runs integration tests
- **Final Inspection (Level 4):**
  - Load tests with multiple concurrent users
  - Tests edge cases and error scenarios
  - Verifies analytics accuracy

**Result:** Fully working like button with real-time updates, analytics, and all tests passing!

---

### **Step 5: Adding a Quick Enhancement** ✅
```bash
/prp-task-create "add animated heart floating effect when users like posts for better visual feedback"
```

**What happens:** Creates focused task list for the animation enhancement

```bash
/prp-task-execute TASK_PRP/PRPs/heart-animation.md
```

**Result:** Beautiful floating heart animation added to the like button

---

## The Quality Control System 🔍

Every feature goes through 4 levels of quality control, just like building inspections:

### **Level 1: Foundation Check** 
```bash
ruff check --fix && mypy .
```
*Like checking if the foundation is level and meets building codes*

### **Level 2: Room-by-Room Check**
```bash
uv run pytest tests/ -v  
```
*Like testing if each room functions correctly (lights work, doors open, etc.)*

### **Level 3: Systems Integration Check**
```bash
curl -X POST http://localhost:8000/api/posts/123/like
```
*Like testing if plumbing, electrical, and heating all work together*

### **Level 4: Real-World Stress Test**
*Like having a family actually live in the house to find any remaining issues*

---

## When to Use Each Command 🤔

### **Use `/prp-planning-create` when:**
- You have a vague idea that needs to become a concrete plan
- You're starting a new major feature
- You need to research and understand the problem space
- You want comprehensive documentation with diagrams

### **Use `/api-contract-define` when:**
- You have architectural plans and need technical specifications
- Frontend and backend teams need to coordinate
- You need exact API endpoint definitions
- You want to prevent integration issues

### **Use `/prp-base-create` when:**
- You need comprehensive implementation instructions
- You're building something completely new
- You want all the context and examples included
- You need the full 4-level validation process

### **Use `/prp-spec-create` when:**
- You need to modify existing code
- You're doing a migration or refactoring
- You need to document current vs. desired state
- You want rollback plans for safety

### **Use `/prp-task-create` when:**
- You have a small, focused change to make  
- You need surgical precision on specific code
- You want immediate validation after each step
- The change affects only a few files

### **Use the execute commands when:**
- You have the corresponding plan/spec/task document
- You're ready to actually build/change the code
- You want systematic, validated implementation
- You trust the AI to follow the detailed instructions

### **Use `/task-list-init` when:**
- You're in a hackathon or time crunch
- You need a quick overview of what needs to be done
- You want to track progress manually
- You're doing rapid prototyping

---

## Common Mistakes (Don't Do These!) ❌

### **❌ Using Commands in Isolation**
```bash
# WRONG - each command creates isolated work
/api-contract-define "user authentication"
/prp-base-create "user authentication" 
```

```bash
# RIGHT - each command builds on the previous
/prp-planning-create "user authentication with social login"
/api-contract-define "create API for authentication described in PRPs/user-auth-prd.md"
/prp-base-create "implement authentication using PRPs/user-auth-prd.md and PRPs/contracts/user-auth-api-contract.md"
```

### **❌ Skipping the Planning Phase**
```bash
# WRONG - jumping straight to implementation
/prp-base-create "some complicated feature"
```

```bash  
# RIGHT - plan first, then implement
/prp-planning-create "some complicated feature"
/prp-base-create "implement feature using PRPs/complicated-feature-prd.md"
```

### **❌ Not Being Specific**
```bash
# WRONG - vague and unhelpful
/prp-base-create "make the app better"
```

```bash
# RIGHT - specific and actionable  
/prp-base-create "add user profile editing with avatar upload, bio editing, and email preferences"
```

---

## Pro Tips for Success 🚀

### **🎯 Always Start with Planning**
For any non-trivial feature, start with `/prp-planning-create`. The time you spend planning saves hours of implementation confusion.

### **🔗 Connect Your Commands**
Always reference previous outputs in your next command. If you created `PRPs/user-auth-prd.md`, reference it in your next command.

### **📝 Be Specific in Your Requests**
Instead of "add authentication," say "add OAuth2 authentication with Google and GitHub integration, including user profile sync and role-based permissions."

### **🔍 Trust the Quality Control**
Let each command run through all 4 quality levels. The validation catches issues before they become problems.

### **🏗️ Think Like an Architect**
Plan the foundation before building the walls. Design the overall structure before implementing individual components.

### **📚 Include Context**
When creating implementation PRPs, reference existing code patterns, documentation URLs, and similar implementations in your codebase.

---

## Quick Reference Card 📋

| Command | Purpose | Input | Output |
|---------|---------|-------|--------|
| `/prp-planning-create` | Master planning | Rough idea | Comprehensive PRD with diagrams |
| `/api-contract-define` | Technical specs | Feature + PRD reference | API contracts and interfaces |
| `/prp-base-create` | Implementation manual | Feature + all references | Complete construction guide |
| `/prp-base-execute` | Build new feature | Implementation PRP path | Working feature |
| `/prp-spec-create` | Renovation plans | Change requirements | Current→desired transformation |
| `/prp-spec-execute` | Execute changes | Spec PRP path | Modified code |
| `/prp-task-create` | Focused work orders | Specific task | Detailed task list |
| `/prp-task-execute` | Do specific tasks | Task PRP path | Completed task |
| `/task-list-init` | Emergency planning | Urgent project | Trackable checklist |

---

## Getting Started Right Now 🚀

### **Your First Feature (5 minutes)**

1. **Pick something simple** like "add a footer to the website with copyright and links"

2. **Plan it:**
   ```bash
   /prp-planning-create "website footer with copyright, privacy policy link, and contact link"
   ```

3. **Create implementation guide:**
   ```bash
   /prp-base-create "implement footer using architecture from PRPs/website-footer-prd.md"
   ```

4. **Build it:**
   ```bash
   /prp-base-execute PRPs/website-footer-implementation.md
   ```

5. **Celebrate!** 🎉 You just used AI to build a feature with proper planning, documentation, and quality control!

---

## Remember: You're the Architect, AI is Your Construction Crew 🏗️

- **You decide WHAT to build** (the vision, requirements, business goals)
- **AI figures out HOW to build it** (technical implementation, code patterns, testing)
- **The PRP system ensures quality** (proper planning, validation, documentation)

This isn't about replacing human creativity - it's about amplifying your ideas with systematic, high-quality implementation.

---

**Ready to build something amazing? Start with `/prp-planning-create` and watch your ideas come to life!** ✨